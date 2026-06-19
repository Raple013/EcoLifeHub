<?php

namespace App\Http\Controllers;

use App\Models\NutritionLog;
use App\Services\GeminiService;
use App\Services\OpenFoodFactsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NutritionController extends Controller
{
    protected GeminiService $gemini;
    protected OpenFoodFactsService $openFoodFacts;

    public function __construct(GeminiService $gemini, OpenFoodFactsService $openFoodFacts)
    {
        $this->gemini = $gemini;
        $this->openFoodFacts = $openFoodFacts;
    }

    public function index()
    {
        $logs = NutritionLog::where('user_id', auth()->id())
            ->whereDate('logged_at', now()->toDateString())
            ->orderBy('logged_at', 'desc')
            ->get();

        $totals = (object) [
            'calories' => $logs->sum('calories'),
            'protein_g' => $logs->sum('protein_g'),
            'carbs_g' => $logs->sum('carbs_g'),
            'sugar_g' => $logs->sum('sugar_g'),
            'fat_g' => $logs->sum('fat_g'),
        ];

        $mealTypes = ['makanan_berat', 'minuman', 'snack'];
        $grouped = [];
        foreach ($mealTypes as $type) {
            $grouped[$type] = $logs->where('meal_type', $type);
        }

        $hasGeminiKey = config('services.gemini.api_key') ? true : false;

        return view('nutrition.index', compact('logs', 'totals', 'grouped', 'hasGeminiKey'));
    }

    public function scan(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:51200',
            'meal_type' => 'required|in:snack,makanan_berat,minuman',
        ]);

        $image = $request->file('image');
        $imageBase64 = base64_encode(file_get_contents($image->path()));

        $result = $this->gemini->analyzeFoodImage($imageBase64);

        if (!$result['success']) {
            return response()->json(['error' => $result['error']], 422);
        }

        $data = $result['data'];
        $path = $image->store('nutrition', 'public');

        return response()->json([
            'food_name' => $data['food_name'],
            'serving_size' => $data['serving_size'] ?? '1 serving',
            'calories' => (float) ($data['calories'] ?? 0),
            'protein_g' => (float) ($data['protein_g'] ?? 0),
            'carbs_g' => (float) ($data['carbs_g'] ?? 0),
            'sugar_g' => (float) ($data['sugar_g'] ?? 0),
            'fat_g' => (float) ($data['fat_g'] ?? 0),
            'image_url' => $path,
            'meal_type' => $request->meal_type,
        ]);
    }

    public function confirm(Request $request)
    {
        $data = $request->validate([
            'food_name' => 'required|string|max:255',
            'calories' => 'required|numeric|min:0',
            'protein_g' => 'nullable|numeric|min:0',
            'carbs_g' => 'nullable|numeric|min:0',
            'sugar_g' => 'nullable|numeric|min:0',
            'fat_g' => 'nullable|numeric|min:0',
            'meal_type' => 'required|in:snack,makanan_berat,minuman',
            'image_url' => 'nullable|string|max:500',
            'source' => 'nullable|string|in:ai_vision,ai_estimated,manual_search,manual_input',
        ]);

        NutritionLog::create([
            'user_id' => auth()->id(),
            'food_name' => $data['food_name'],
            'calories' => $data['calories'],
            'protein_g' => $data['protein_g'] ?? 0,
            'carbs_g' => $data['carbs_g'] ?? 0,
            'sugar_g' => $data['sugar_g'] ?? 0,
            'fat_g' => $data['fat_g'] ?? 0,
            'meal_type' => $data['meal_type'],
            'image_url' => $data['image_url'] ?? null,
            'source' => $data['source'] ?? 'manual_search',
            'logged_at' => now(),
        ]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'redirect' => route('nutrition.history')]);
        }

        return redirect()->route('nutrition.history')->with('success', __('Food logged successfully!'));
    }

    public function search(Request $request)
    {
        $request->validate(['q' => 'required|string|max:100']);

        $results = $this->openFoodFacts->search($request->q);

        if (!empty($results)) {
            return response()->json(['results' => $results, 'source' => 'manual_search']);
        }

        $geminiResult = $this->gemini->estimateNutrition($request->q);

        if ($geminiResult['success']) {
            $data = $geminiResult['data'];
            return response()->json(['results' => [[
                'food_name' => $data['food_name'],
                'calories' => (float) ($data['calories'] ?? 0),
                'protein_g' => (float) ($data['protein_g'] ?? 0),
                'carbs_g' => (float) ($data['carbs_g'] ?? 0),
                'sugar_g' => (float) ($data['sugar_g'] ?? 0),
                'fat_g' => (float) ($data['fat_g'] ?? 0),
                'serving_size' => $data['serving_size'] ?? '100g',
            ]], 'source' => 'ai_estimated']);
        }

        return response()->json(['results' => [], 'source' => 'none']);
    }

    public function manual(Request $request)
    {
        $data = $request->validate([
            'food_name' => 'required|string|max:255',
            'calories' => 'required|numeric|min:0',
            'protein_g' => 'nullable|numeric|min:0',
            'carbs_g' => 'nullable|numeric|min:0',
            'sugar_g' => 'nullable|numeric|min:0',
            'fat_g' => 'nullable|numeric|min:0',
            'meal_type' => 'required|in:snack,makanan_berat,minuman',
        ]);

        NutritionLog::create([
            'user_id' => auth()->id(),
            'food_name' => $data['food_name'],
            'calories' => $data['calories'],
            'protein_g' => $data['protein_g'] ?? 0,
            'carbs_g' => $data['carbs_g'] ?? 0,
            'sugar_g' => $data['sugar_g'] ?? 0,
            'fat_g' => $data['fat_g'] ?? 0,
            'meal_type' => $data['meal_type'],
            'source' => 'manual_input',
            'logged_at' => now(),
        ]);

        return redirect()->route('nutrition.history')->with('success', __('Food logged successfully!'));
    }

    public function history(Request $request)
    {
        $query = NutritionLog::where('user_id', auth()->id());

        if ($request->filled('date')) {
            $query->whereDate('logged_at', $request->date);
        } elseif ($request->filled('period')) {
            $query->where('logged_at', '>=', match ($request->period) {
                'week' => now()->subWeek(),
                'month' => now()->subMonth(),
                default => now()->startOfDay(),
            });
        }

        $logs = $query->orderBy('logged_at', 'desc')->paginate(50);

        $totals = (object) [
            'calories' => $logs->sum('calories'),
            'protein_g' => $logs->sum('protein_g'),
            'carbs_g' => $logs->sum('carbs_g'),
            'sugar_g' => $logs->sum('sugar_g'),
            'fat_g' => $logs->sum('fat_g'),
        ];

        return view('nutrition.history', compact('logs', 'totals'));
    }

    public function destroy(NutritionLog $nutritionLog)
    {
        if ($nutritionLog->user_id !== auth()->id()) {
            abort(403);
        }

        if ($nutritionLog->image_url) {
            Storage::disk('public')->delete($nutritionLog->image_url);
        }

        $nutritionLog->delete();

        return redirect()->route('nutrition.index')->with('success', __('Food entry deleted.'));
    }
}
