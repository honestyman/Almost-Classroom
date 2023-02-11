<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Exception;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $posts_final = array();
        $comments_final = array();
        $groups_private = array();
        $groups_public = array();
        $groups_public[] = Group::where('public', 1)->get();
        $groups_private[] = $user->groups->where('public', '!=', 1);

        $groups_final = array_merge($groups_private, $groups_public);
        $groups_final = array_unique($groups_final);
        foreach ($groups_final as $groups) {
            foreach ($groups as $group) {
                $posts_final[] = Post::where('group_id', $group->id)->get();
                $posts = Post::where('group_id', $group->id)->get();
                foreach ($posts as $post) {
                    $comments_final[] = Comment::where('post_id', $post->id)->get();
                    $comments = Comment::where('post_id', $post->id)->get();
                }
            }
        };
        return view('dashboard', ['user' => $user, 'posts' => $posts_final, 'groups' => $groups_final,]);
    }

    public function add(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        switch ($request->workingWith) {
            case 'image':
                //uprava profilove fotky
                if ($request->hasFile('image')) {
                    $filename = Auth::id() . $request->image->getClientOriginalName();
                    $request->image->storeAs('images', $filename, 'public');
                    User::where('id', Auth::id())->update(['image' => $filename]);
                }
                break;
            case 'bio':
                //uprava uzivatelskeho popisku
                $newBio = User::updateOrCreate([
                    'id' => Auth::id(),
                ], [
                    'bio' => $request->content,
                ]);
                break;
            default:
                dd($request);
                break;
        }
        return redirect()->back();
    }

    public function del(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        switch ($request->workingWith) {
            case 'group':
                Group::destroy($request->id);
                break;
            case 'post':
                Comment::where('post_id', $request->id)->delete();
                Post::destroy($request->id);
                break;
            default:
                dd($request);
                break;
        }
        return redirect()->back();
    }
}
