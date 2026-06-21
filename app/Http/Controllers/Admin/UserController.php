<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
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
        $activeUsers = User::where('status', 'aktif')->count();
        $blockedUsers = User::where('status', 'nonaktif')->count();
        $adminUsers = User::whereHas('role', fn($q) => $q->where('nama_role', 'admin'))->count();

        return view('admin.users.index', compact('users', 'totalUsers', 'activeUsers', 'blockedUsers', 'adminUsers'));
    }

    public function show(User $user)
    {
        $activities = $user->activityLogs()->latest()->take(10)->get();
        $histories = $user->dailyLogs()->latest()->take(10)->get();

        return view('admin.users.show', compact('user', 'activities', 'histories'));
    }

    public function block(Request $request, User $user)
    {
        if ($user->hasRole('admin')) {
            return back()->with('error', __('Cannot block an admin user.'));
        }

        $reason = $request->input('reason');
        $user->block($reason);

        return back()->with('success', __('User has been blocked.'));
    }

    public function unblock(Request $request, User $user)
    {
        $user->unblock();

        return back()->with('success', __('User has been unblocked.'));
    }
}
