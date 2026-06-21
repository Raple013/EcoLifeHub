<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Models\ActivityLog;
use App\Models\Comment;
use App\Models\DiscussionThread;
use App\Models\QuizQuestion;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalArticles = Article::count();
        $publishedArticles = Article::where('is_published', true)->count();
        $todayActivities = ActivityLog::whereDate('activity_date', now()->toDateString())->count();
        $activeToday = ActivityLog::whereDate('activity_date', now()->toDateString())
            ->distinct('user_id')->count('user_id');
        $totalQuizQuestions = QuizQuestion::count();
        $totalComments = Comment::count();
        $totalThreads = DiscussionThread::count();
        $latestUsers = User::latest()->take(5)->get();
        $latestArticles = Article::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalArticles', 'publishedArticles',
            'todayActivities', 'activeToday',
            'totalQuizQuestions',
            'totalComments', 'totalThreads',
            'latestUsers', 'latestArticles'
        ));
    }
}
