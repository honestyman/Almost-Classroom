<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        Comment::make(
            [
                'content' => $request->content,
            ]
        )->user()->associate(auth()->user())->post()->associate($post)->save();
        return redirect()->back();
    }

    public function update(Request $request, Post $post, Comment $comment)
    {
        $this->authorize('edit', $comment);
        $comment->update(
            ['content' => $request->content]
        );
        return redirect()->back();
    }

    public function destroy(Post $post, Comment $comment)
    {
        $this->authorize('destroy', $comment);
        $comment->delete();
        return redirect()->back();
    }
}
