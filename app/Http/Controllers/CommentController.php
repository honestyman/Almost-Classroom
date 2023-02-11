<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function add(Request $request) {
        $comment = Comment::updateOrCreate(
            [
                'content' => $request->content,
                'user_id' => Auth::id(),
                'post_id' => $request->id,
            ]
        );
        return redirect()->back();
    }

    public function edit(Request $request, Comment $comment) {
        $this->authorize('edit', $comment);
        $comment->update(['content' => $request->content]);
        return redirect()->back();
    }

    public function delete(Comment $comment) {
        $this->authorize('delete', $comment);
        Comment::destroy($comment->id);
        return redirect()->back();
    }
}
