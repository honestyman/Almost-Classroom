<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;
use App\Models\Post;
use App\Models\PostUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function show(Request $request) {
        $post = Post::findOrFail($request->id2);
        return view('post', ['post' => $post],);
    }

    public function finished(Request $request) {
        $user = User::findOrFail(Auth::user()->id);
        $post = Post::findOrFail($request->post_id);
        $finished = PostUser::updateOrCreate([
            'post_id' => $request->post_id,
            'user_id' => $request->user_id,
            ], [
            'post_id' =>  $request->post_id,
            'user_id' => $request->user_id,
            'finished' => $request->finished,
            'post_answer' => $request->post_answer,
            ]);
        
        return redirect()->action(
            [PostController::class, 'show'], ['id' => $post->group->id, 'id2' => $post->id]
        );
    }
    
}
