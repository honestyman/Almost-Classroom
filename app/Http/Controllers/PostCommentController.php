<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class PostCommentController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment');
    }

    public function store(Request $request, Post $post)
    {
        $this->authorize('store', [Comment::class, $post]);
        try {
            Comment::make([
                'content' => $request->content,
            ])->user()->associate(auth()->user())->post()->associate($post)->save();
            return redirect()->back()->with('success', 'Komentář byl úspěšně přidán.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->back()->with('error', 'Něco se pokazilo.');
    }

    public function update(Request $request, Post $post, Comment $comment)
    {
        try {
            $comment->update(
                ['content' => $request->content]
            );
            return redirect()->back()->with('success', 'Komentář byl úspěšně upraven.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->back()->with('error', 'Něco se pokazilo.');
    }

    public function destroy(Post $post, Comment $comment)
    {
        try {
            $comment->delete();
            return redirect()->back()->with('success', 'Komentář byl úspěšně smazán.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->back()->with('error', 'Něco se pokazilo.');
    }
}
