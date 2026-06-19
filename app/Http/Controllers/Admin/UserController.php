<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%");
            });
        }

        $users = $query->latest()->paginate(20);
        $totalUsers = User::count();

        return view('admin.users.index', compact('users', 'totalUsers'));
    }

    public function show(User $user)
    {
        $activities = $user->activityLogs()->latest()->take(10)->get();
        $histories = $user->dailyHistories()->latest()->take(10)->get();

        return view('admin.users.show', compact('user', 'activities', 'histories'));
    }
}
