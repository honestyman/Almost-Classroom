<?php

namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    function sort(Request $request)
    {
        if ($request->ajax()) {
            $sort = $request->sort;
            $search = $request->search;
            $groups = $request->groups;
            $paginate_count = 6;

            switch ($sort) {
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
                    $posts = Post::search($search)->orderBy($tridit_dle, $tridit_jak)->paginate($paginate_count);
                    break;
                case 2:
                    $posts = Post::search($search)->query(function ($builder) {
                        $builder->whereHas('group', function ($builder) {
                            $builder->where('public', 0);
                        });
                    })->orderBy($tridit_dle, $tridit_jak)->paginate($paginate_count);
                    break;
                case 3:
                    $posts = Post::search($search)->query(function ($builder) {
                        $builder->whereHas('group', function ($builder) {
                            $builder->where('public', 1);
                        });
                    })->orderBy($tridit_dle, $tridit_jak)->paginate($paginate_count);
                    break;
                default:
                    $posts = Post::search($search)->orderBy($tridit_dle, $tridit_jak)->paginate($paginate_count);
                    break;
            }
            return view('posts', ['posts' => $posts])->render();
        }
        return redirect()->route('home')->with('error', 'Něco se pokazilo.');
    }
}
