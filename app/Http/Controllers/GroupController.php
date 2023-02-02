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
    public function show(Request $request)
    {
        $group = Group::findOrFail($request->id);
        $p = 0;
        foreach ($group->users as $user) {
            if (Auth::user()->id == $user->id) {
                $p++;
            }
        }
        if ($p == 1) {
            $finished_final = array();
            foreach ($group->posts as $post) {
                $finished_final[] = PostUser::where('post_id', $post->id)->where('user_id', Auth::user()->id)->get('finished');
            }
            return view('group', ['site' => $group, 'finished' => $finished_final],);
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function users(Request $request)
    {
        $group = Group::findOrFail($request->id);
        return view('users', ['site' => $group,],);
    }
    public function user(Request $request)
    {
        $user = User::findOrFail($request->id);
        $pocet = 0;
        $private_skupiny = array();
        $hotove_prispevky = array();
        $skupiny =  $user->groups;
        foreach ($skupiny as $skupina) {
            if ($skupina->public == 0) {
                $private_skupiny[] = Group::where('id', $skupina->id)->get();
            }
        }
        $ukoly = $user->postusers;
        foreach ($ukoly as $ukol) {
            if ($ukol->finished == 1) {
                $hotove_prispevky[] = PostUser::where('id', $ukol->id)->get();
            }
        }

        return view('user', ['user' => $user, 'private_skupiny' => $private_skupiny, 'hotove_prispevky' => $hotove_prispevky,],);
    }
}
