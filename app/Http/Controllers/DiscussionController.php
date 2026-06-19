<?php

namespace App\Http\Controllers;

use App\Models\DiscussionThread;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function index(Request $request)
    {
        $query = DiscussionThread::with('user.achievements', 'replies');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('title', 'like', "%{$s}%")
                  ->orWhere('body', 'like', "%{$s}%");
            });
        }

        $threads = $query->pinnedFirst()->paginate(15);
        $categories = DiscussionThread::selectRaw('category, count(*) as total')
            ->groupBy('category')->orderBy('total', 'desc')->get();

        return view('discussions.index', compact('threads', 'categories'));
    }

    public function create()
    {
        return view('discussions.form', ['thread' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:10000',
            'category' => 'required|string|in:general,nutrition,sdg,health,tips, lainnya',
        ]);

        DiscussionThread::create([
            'user_id' => auth()->id(),
            'title' => $data['title'],
            'body' => $data['body'],
            'category' => $data['category'],
        ]);

        return redirect()->route('discussions.index')
            ->with('success', __('Thread created.'));
    }

    public function show(DiscussionThread $thread)
    {
        $thread->load('user.achievements', 'replies.user.achievements');
        return view('discussions.show', compact('thread'));
    }

    public function destroy(DiscussionThread $thread)
    {
        if ($thread->user_id !== auth()->id() && !auth()->user()?->hasRole('admin')) {
            abort(403);
        }

        $thread->delete();
        return redirect()->route('discussions.index')
            ->with('success', __('Thread deleted.'));
    }
}
