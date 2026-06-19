<?php

namespace App\Http\Controllers;

use App\Models\NutritionLog;
use App\Models\ActivityLog;
use App\Models\DailyHistory;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date', now()->toDateString());

        $nutritionLogs = NutritionLog::where('user_id', auth()->id())
            ->whereDate('logged_at', $date)
            ->orderBy('logged_at', 'asc')
            ->get();

        $activities = ActivityLog::where('user_id', auth()->id())
            ->whereDate('activity_date', $date)
            ->orderBy('activity_date', 'asc')
            ->get();

        $dailyHistory = DailyHistory::where('user_id', auth()->id())
            ->whereDate('history_date', $date)
            ->first();

        $nutritionTotals = (object) [
            'calories' => $nutritionLogs->sum('calories'),
            'protein_g' => $nutritionLogs->sum('protein_g'),
            'carbs_g' => $nutritionLogs->sum('carbs_g'),
            'sugar_g' => $nutritionLogs->sum('sugar_g'),
            'fat_g' => $nutritionLogs->sum('fat_g'),
        ];

        $activityTotals = (object) [
            'minutes' => $activities->sum('duration_minutes'),
            'calories' => $activities->sum('calories_burned'),
            'distance' => $activities->sum('distance_km'),
        ];

        return view('report', compact(
            'date',
            'nutritionLogs',
            'activities',
            'dailyHistory',
            'nutritionTotals',
            'activityTotals'
        ));
    }
}
