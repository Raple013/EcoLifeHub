<?php

namespace App\Http\Controllers;

use App\Models\DailyHistory;
use App\Models\ActivityLog;
use App\Models\NutritionLog;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = DailyHistory::where('user_id', auth()->id())
            ->latest('history_date')
            ->get();

        $activitiesByDate = ActivityLog::where('user_id', auth()->id())
            ->latest('activity_date')
            ->get()
            ->groupBy(fn($a) => $a->activity_date->toDateString());

        $nutritionByDate = NutritionLog::where('user_id', auth()->id())
            ->latest('logged_at')
            ->get()
            ->groupBy(fn($l) => $l->logged_at->toDateString());

        return view('history', compact('histories', 'activitiesByDate', 'nutritionByDate'));
    }
}
