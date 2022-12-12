<?php

namespace App\Http\Controllers;


use App\Models\Group;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SortController extends Controller
{
    function sort(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $groups = $request->get('groups');
            $user = User::findOrFail(Auth::user()->id);

            switch ($query) {
                case 1:
                    $tridit_dle = 'id';
                    $tridit_jak = 'asc';
                    break;
                case 2:
                    $tridit_dle = 'id';
                    $tridit_jak = 'desc';
                    break;
                case 3:
                    $tridit_dle = 'deadline';
                    $tridit_jak = 'asc';
                    break;
                case 4:
                    $tridit_dle = 'deadline';
                    $tridit_jak = 'desc';
                    break;
                case 5:
                    $tridit_dle = 'name';
                    $tridit_jak = 'asc';
                    break;
                case 6:
                    $tridit_dle = 'name';
                    $tridit_jak = 'desc';
                    break;
                default:
                    $tridit_dle = 'deadline';
                    $tridit_jak = 'desc';
                    break;
            }

            switch ($groups) {
                case 1:
                    $groups_final = $user->groups();
                    if ($query < 5) {
                        $posts = array();
                        $posts = Post::orderBy($tridit_dle, $tridit_jak)->get();
                        return view('prispevky', ['prispevky' => $posts])->render();
                    }
                    else {
                        $groups_final = $user->groups()->orderBy($tridit_dle, $tridit_jak)->get();
                    }
                    break;
                case 2:
                    $groups_final = $user->groups()->where('public', '!=', 1)->get();
                    foreach ($groups_final as $group) {
                        $id[] = $group->id;
                    }
                    if ($query < 5) {
                        $posts = Post::whereIn('group_id', $id)->orderBy($tridit_dle, $tridit_jak)->get();
                        return view('prispevky', ['prispevky' => $posts])->render();
                    }
                    else {
                        $groups_final = $user->groups()->where('public', '!=', 1)->orderBy($tridit_dle, $tridit_jak)->get();
                    }
                    break;
                case 3:
                    $groups_final = Group::where('public', 1)->get();
                    foreach ($groups_final as $group) {
                        $id[] = $group->id;
                    }
                    if ($query < 5) {
                        $posts = Post::whereIn('group_id', $id)->orderBy($tridit_dle, $tridit_jak)->get();
                        return view('prispevky', ['prispevky' => $posts])->render();
                    }
                    else {
                        $groups_final = Group::where('public', 1)->orderBy($tridit_dle, $tridit_jak)->get();
                    }
                    break;
                default:
                    $groups_final = $user->groups();
                    if ($query < 5) {
                        $posts = array();
                        $posts = Post::orderBy($tridit_dle, $tridit_jak)->get();
                        return view('prispevky', ['prispevky' => $posts])->render();
                    }
                    break;
            }
            return view('prispevky', ['data' => $groups_final])->render();
        }
    }
}
