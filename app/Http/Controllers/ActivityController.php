<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\DailyHistory;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $today = now()->toDateString();
        $user = auth()->user();

        $todaysActivities = ActivityLog::where('user_id', $user->id)
            ->where('activity_date', $today)
            ->latest()
            ->get();

        $totalMinutes = $todaysActivities->sum('duration_minutes');
        $totalCalories = $todaysActivities->sum('calories_burned');
        $totalDistance = $todaysActivities->sum('distance_km');

        $filter = $request->get('filter', 'week');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        if ($filter === 'all') {
            $startDate = null;
            $endDate = null;
        } elseif ($startDate && $endDate) {
            $filter = 'custom';
        } elseif ($filter === 'today') {
            $startDate = $today;
            $endDate = $today;
        } elseif ($filter === 'month') {
            $startDate = now()->startOfMonth()->toDateString();
            $endDate = $today;
        } else {
            $startDate = now()->startOfWeek()->toDateString();
            $endDate = $today;
        }

        $query = ActivityLog::where('user_id', $user->id);

        if ($startDate && $endDate) {
            $query->whereBetween('activity_date', [$startDate, $endDate]);
        }

        $filteredActivities = (clone $query)->latest('activity_date')->latest('created_at')->get();
        $filteredMinutes = $filteredActivities->sum('duration_minutes');
        $filteredCalories = $filteredActivities->sum('calories_burned');
        $filteredDistance = $filteredActivities->sum('distance_km');
        $activityCount = $filteredActivities->count();

        return view('activity-tracker', compact(
            'todaysActivities',
            'totalMinutes',
            'totalCalories',
            'totalDistance',
            'filteredActivities',
            'filteredMinutes',
            'filteredCalories',
            'filteredDistance',
            'activityCount',
            'filter',
            'startDate',
            'endDate',
        ));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'activity_type' => ['required', 'string', 'max:50'],
            'pace_intensity' => ['nullable', 'string', 'max:50'],
            'duration_minutes' => ['required', 'integer', 'min:1', 'max:1440'],
            'distance_km' => ['nullable', 'numeric', 'min:0', 'max:999.99'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $calories = null;
        if ($user->weight_kg && $validated['pace_intensity']) {
            $met = ActivityLog::getMetValue(
                $validated['activity_type'],
                $validated['pace_intensity']
            );
            $calories = ActivityLog::calculateCalories(
                $met,
                $user->weight_kg,
                $validated['duration_minutes']
            );
        }

        $activity = ActivityLog::create([
            'user_id' => $user->id,
            'activity_type' => $validated['activity_type'],
            'pace_intensity' => $validated['pace_intensity'],
            'duration_minutes' => $validated['duration_minutes'],
            'distance_km' => $validated['distance_km'] ?? null,
            'calories_burned' => $calories,
            'weight_kg' => $user->weight_kg,
            'activity_date' => now()->toDateString(),
            'notes' => $validated['notes'],
        ]);

        $todayActivities = ActivityLog::where('user_id', $user->id)
            ->where('activity_date', now()->toDateString())
            ->get();

        DailyHistory::updateOrCreate(
            [
                'user_id' => $user->id,
                'history_date' => now()->toDateString(),
            ],
            [
                'activity_minutes' => $todayActivities->sum('duration_minutes'),
                'activity_calories' => $todayActivities->sum('calories_burned'),
            ]
        );

        return redirect()->route('activities')->with('success', 'Activity logged successfully!');
    }

    public function destroy(ActivityLog $activity)
    {
        if ($activity->user_id !== auth()->id()) {
            abort(403);
        }

        $activity->delete();

        $todayActivities = ActivityLog::where('user_id', auth()->id())
            ->where('activity_date', now()->toDateString())
            ->get();

        DailyHistory::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'history_date' => now()->toDateString(),
            ],
            [
                'activity_minutes' => $todayActivities->sum('duration_minutes'),
                'activity_calories' => $todayActivities->sum('calories_burned'),
            ]
        );

        return redirect()->route('activities')->with('success', 'Activity deleted.');
    }
}
