<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;
use App\Models\Post;
use App\Models\PostUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function show(Request $request) {
        $group = Group::findOrFail($request->id);
        $finished_final = array();
        
        foreach ($group->posts as $post) {
            $finished_final[] = PostUser::where('post_id', $post->id)->where('user_id', Auth::user()->id)->get('finished');
        }
        
        return view('group', ['site' => $group, 'finished' => $finished_final],);
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
            ]);
        
        return redirect()->action(
            [GroupController::class, 'show'], ['id' => $post->group->id]
        );
    }
}
