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
        $group = $post = Group::findOrFail($request->id);
        $post = Post::findOrFail($request->id2);
        $p = 0;
        foreach ($post->group->users as $user) {
            if (Auth::id() == $user->id) {
                $p++;
            }
        }
        if ($p == 1) {
            return view('post', ['post' => $post, 'group' => $group],);
        }
        else {
            return redirect()->route('dashboard');
        }
    }

    public function finished(Request $request) {
        $user = User::findOrFail(Auth::id());
        $post = Post::findOrFail($request->id);
        $finished = PostUser::updateOrCreate([
            'post_id' => $request->id,
            'user_id' => Auth::id(),
            ], [
            'post_id' =>  $request->id,
            'user_id' => Auth::id(),
            'finished' => $request->finished,
            'post_answer' => $request->post_answer,
            ]);
        
        return redirect()->action(
            [PostController::class, 'show'], ['id' => $post->group->id, 'id2' => $post->id]
        );
    }
    
}
