<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $user->syncAchievements();

        $allAchievements = Achievement::orderBy('level')->get();
        $userAchievements = $user->achievements()->orderBy('level')->get();

        return view('achievements', compact('allAchievements', 'userAchievements'));
    }
}
