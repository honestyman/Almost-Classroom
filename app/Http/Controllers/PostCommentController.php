<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment');
    }

    public function store(Request $request, Post $post)
    {
        $this->authorize('store', [Comment::class, $post]);
        Comment::make([
            'content' => $request->content,
        ])->user()->associate(auth()->user())->post()->associate($post)->save();
        return redirect()->back();
    }

    public function update(Request $request, Post $post, Comment $comment)
    {
        $comment->update(
            ['content' => $request->content]
        );
        return redirect()->back();
    }

    public function destroy(Post $post, Comment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }
}
