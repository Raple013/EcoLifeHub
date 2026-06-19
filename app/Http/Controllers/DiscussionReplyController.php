<?php

namespace App\Http\Controllers;

use App\Models\DiscussionReply;
use App\Models\DiscussionThread;
use Illuminate\Http\Request;

class DiscussionReplyController extends Controller
{
    public function store(Request $request, DiscussionThread $thread)
    {
        if ($thread->is_locked) {
            return redirect()->back()->with('error', __('This thread is locked.'));
        }

        $data = $request->validate([
            'body' => 'required|string|max:5000',
        ]);

        $thread->replies()->create([
            'user_id' => auth()->id(),
            'body' => $data['body'],
        ]);

        return redirect()->back()->with('success', __('Reply posted.'));
    }

    public function destroy(DiscussionReply $reply)
    {
        if ($reply->user_id !== auth()->id() && !auth()->user()?->hasRole('admin')) {
            abort(403);
        }

        $reply->delete();
        return redirect()->back()->with('success', __('Reply deleted.'));
    }
}
