<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Article;
use App\Models\MealLog;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('admin') && !request()->has('as')) {
            return redirect()->route('admin.dashboard');
        }

        $todayActivity = ActivityLog::where('user_id', $user->id)
            ->where('activity_date', now()->toDateString())
            ->get();
        $activityMinutes = $todayActivity->sum('duration_minutes');
        $activityCalories = $todayActivity->sum('calories_burned');

        $todayNutrition = MealLog::where('user_id', $user->id)
            ->whereDate('logged_at', now()->toDateString())
            ->get();
        $nutritionCalories = $todayNutrition->sum('calories');
        $nutritionProtein = $todayNutrition->sum('protein_g');
        $nutritionCarbs = $todayNutrition->sum('carbs_g');
        $nutritionFat = $todayNutrition->sum('fat_g');

        $quizScore = $user->quiz_score ?? 0;

        $badge = '🌱 Eco Starter';
        if ($quizScore >= 100) {
            $badge = '🏆 SDG Champion';
        } elseif ($quizScore >= 80) {
            $badge = '🥇 Eco Explorer';
        } elseif ($quizScore >= 60) {
            $badge = '🥈 Eco Beginner';
        }

        $weather = null;
        if ($user->city) {
            $weather = app(\App\Services\WeatherService::class)->getAll($user->city);
        }

        $user->syncAchievements();

        $dailyTip = \Illuminate\Support\Facades\Cache::remember('daily_tip_' . now()->toDateString(), now()->endOfDay(), function () {
            return Article::where('is_published', true)->inRandomOrder()->first();
        });

        return view('dashboard', compact(
            'quizScore', 'badge', 'activityMinutes', 'activityCalories',
            'nutritionCalories', 'nutritionProtein', 'nutritionCarbs', 'nutritionFat',
            'weather', 'dailyTip'
        ));
    }
}
