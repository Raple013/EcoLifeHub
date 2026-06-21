<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\DailyLog;
use App\Models\User;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'today');
        $now = now();

        $dateRange = match ($period) {
            'today' => [$now->copy()->startOfDay(), $now->copy()->endOfDay()],
            'week' => [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()],
            'month' => [$now->copy()->startOfMonth(), $now->copy()->endOfMonth()],
            default => [$now->copy()->startOfDay(), $now->copy()->endOfDay()],
        };

        $totalUsers = User::count();
        $activeUsers = ActivityLog::whereBetween('activity_date', $dateRange)->distinct('user_id')->count('user_id');
        $totalActivities = ActivityLog::whereBetween('activity_date', $dateRange)->count();
        $totalMinutes = ActivityLog::whereBetween('activity_date', $dateRange)->sum('duration_minutes');
        $totalCalories = ActivityLog::whereBetween('activity_date', $dateRange)->sum('calories_burned');
        $totalQuiz = DailyLog::whereBetween('history_date', $dateRange)->avg('quiz_score');

        $topActivities = ActivityLog::whereBetween('activity_date', $dateRange)
            ->selectRaw('activity_type, count(*) as total, sum(duration_minutes) as minutes')
            ->groupBy('activity_type')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        return view('admin.data.index', compact(
            'period', 'totalUsers', 'activeUsers', 'totalActivities',
            'totalMinutes', 'totalCalories', 'totalQuiz',
            'topActivities'
        ));
    }
}
