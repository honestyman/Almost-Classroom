<?php

namespace App\Http\Controllers;


use App\Models\Group;
use App\Models\Post;
use App\Models\User;
use Hamcrest\Type\IsNumeric;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use function PHPUnit\Framework\isEmpty;

class ContentController extends Controller
{
    function sort(Request $request)
    {
        if ($request->ajax()) {
            $paginate_count = 6;
            $sort = $request->get('sort');
            $groups = $request->get('groups');
            $search = $request->get('search');
            $address = $request->get('address');
            $user = User::findOrFail(Auth::id());
            
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

            if ($search != "") {
                if ($address) {
                    $posts = Post::where('group_id', $address)->where('name', 'like', '%' . $search . '%')->orWhere('content', 'like', '%' . $search . '%')->orderBy($tridit_dle, $tridit_jak)->paginate($paginate_count);
                } else {
                    $groups_final = $user->groups()->get();
                    foreach ($groups_final as $group) {
                        $id[] = $group->id;
                    }
                    $posts = Post::whereIn('group_id', $id)->where('name', 'like', '%' . $search . '%')->orWhere('content', 'like', '%' . $search . '%')->orderBy($tridit_dle, $tridit_jak)->paginate($paginate_count);
                }
                return view('posts', ['prispevky' => $posts])->render();
            }

            switch ($groups) {
                case 1:
                    if ($sort < 5) {
                        $posts = array();
                        if ($address) {
                            $posts = Post::where('group_id', $address)->orderBy($tridit_dle, $tridit_jak)->paginate($paginate_count);
                        } else {
                            $groups_final = $user->groups;
                            foreach ($groups_final as $group) {
                                $id[] = $group->id;
                            }
                            $posts = Post::whereIn('group_id', $id)->orderBy($tridit_dle, $tridit_jak)->paginate($paginate_count);
                        }
                        return view('posts', ['prispevky' => $posts])->render();
                    } else {
                        $groups_final = $user->groups()->orderBy($tridit_dle, $tridit_jak)->get();
                    }
                    break;
                case 2:
                    if ($sort < 5) {
                        if ($address) {
                            $posts = Post::where('group_id', $address)->orderBy($tridit_dle, $tridit_jak)->paginate($paginate_count);
                        } else {
                            $groups_final = $user->groups()->where('public', '!=', 1)->get();
                            foreach ($groups_final as $group) {
                                $id[] = $group->id;
                            }
                            $posts = Post::whereIn('group_id', $id)->orderBy($tridit_dle, $tridit_jak)->paginate($paginate_count);
                        }
                        return view('posts', ['prispevky' => $posts])->render();
                    } else {
                        $groups_final = $user->groups()->where('public', '!=', 1)->orderBy($tridit_dle, $tridit_jak)->get();
                    }
                    break;
                case 3:
                    if ($sort < 5) {
                        if ($address) {
                            $posts = Post::where('group_id', $address)->orderBy($tridit_dle, $tridit_jak)->paginate($paginate_count);
                        } else {
                            $groups_final = Group::where('public', 1)->get();
                            foreach ($groups_final as $group) {
                                $id[] = $group->id;
                            }
                            $posts = Post::whereIn('group_id', $id)->orderBy($tridit_dle, $tridit_jak)->paginate($paginate_count);
                        }
                        return view('posts', ['prispevky' => $posts])->render();
                    } else {
                        $groups_final = Group::where('public', 1)->orderBy($tridit_dle, $tridit_jak)->get();
                    }
                    break;
                default:
                    if ($sort < 5) {
                        if ($address) {
                            $posts = Post::where('group_id', $address)->orderBy($tridit_dle, $tridit_jak)->paginate($paginate_count);
                        } else {
                            $groups_final = $user->groups;
                            foreach ($groups_final as $group) {
                                $id[] = $group->id;
                            }
                            $posts = array();
                            $posts = Post::whereIn('group_id', $id)->orderBy($tridit_dle, $tridit_jak)->paginate($paginate_count);
                        }
                        return view('posts', ['prispevky' => $posts])->render();
                    } else {
                        $groups_final = $user->groups()->orderBy($tridit_dle, $tridit_jak)->get();
                    }
                    break;
            }
            foreach ($groups_final as $group) {
                $id[] = $group->id;
                $posts = array();
                $posts = Post::whereIn('group_id', $id)->orderBy($tridit_dle, $tridit_jak)->paginate($paginate_count);
                return view('posts', ['prispevky' => $posts])->render();
            }
        }
        return redirect()->route('dashboard');
    }
}
