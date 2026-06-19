<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $data = $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        $article->comments()->create([
            'user_id' => auth()->id(),
            'body' => $data['body'],
        ]);

        return redirect()->back()->with('success', __('Comment posted.'));
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id() && !auth()->user()?->hasRole('admin')) {
            abort(403);
        }

        $comment->delete();

        return redirect()->back()->with('success', __('Comment deleted.'));
    }
}
