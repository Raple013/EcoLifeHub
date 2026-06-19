<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscussionThread;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function index()
    {
        $threads = DiscussionThread::with('user', 'replies')
            ->latest()->paginate(20);
        return view('admin.discussions.index', compact('threads'));
    }

    public function pin(DiscussionThread $thread)
    {
        $thread->update(['is_pinned' => !$thread->is_pinned]);
        return redirect()->back()->with('success',
            $thread->is_pinned ? __('Thread pinned.') : __('Thread unpinned.'));
    }

    public function lock(DiscussionThread $thread)
    {
        $thread->update(['is_locked' => !$thread->is_locked]);
        return redirect()->back()->with('success',
            $thread->is_locked ? __('Thread locked.') : __('Thread unlocked.'));
    }

    public function destroy(DiscussionThread $thread)
    {
        $thread->delete();
        return redirect()->route('admin.discussions.index')
            ->with('success', __('Thread deleted.'));
    }
}
