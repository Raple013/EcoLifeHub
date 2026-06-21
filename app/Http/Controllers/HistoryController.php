<?php

namespace App\Http\Controllers;

use App\Models\DailyLog;
use App\Models\ActivityLog;
use App\Models\MealLog;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = DailyLog::where('user_id', auth()->id())
            ->latest('history_date')
            ->get();

        $activitiesByDate = ActivityLog::where('user_id', auth()->id())
            ->latest('activity_date')
            ->get()
            ->groupBy(fn($a) => $a->activity_date->toDateString());

        $nutritionByDate = MealLog::where('user_id', auth()->id())
            ->latest('logged_at')
            ->get()
            ->groupBy(fn($l) => $l->logged_at->toDateString());

        return view('history', compact('histories', 'activitiesByDate', 'nutritionByDate'));
    }
}
