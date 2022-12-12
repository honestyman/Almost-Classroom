<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Exception;

class HomeController extends Controller
{
    public function index(Request $request) {
        $user = User::findOrFail(Auth::user()->id);
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

    public function add(Request $request) {
        $user = User::findOrFail(Auth::user()->id);
        switch ($request->workingWith) {
            case 'group':
                if ($request->public != 1) {
                    $request->public = 0;
                }
                //dodělat že pri vytvoření public skupiny se do ní automaticky přidají všichni uživatelé
                $newGroup = Group::updateOrCreate(
                    ['name' => $request->name,
                    'user_id' => $request->user_id,
                    'public' => $request->public,
                    'invite_key' => Str::random(10)]);
                    $user->groups()->attach(Group::all()->count());
                break;
            case 'post':
                $newPost = Post::updateOrCreate(
                    ['name' => $request->name,
                    'content' => $request->content,
                    'type' => $request->type,
                    'deadline' => $request->deadline,
                    'group_id' => $request->group_id,
                    'user_id'=> $request->user_id,]);
                    $user->posts()->attach(Post::all()->count());
                break;
            case 'comment':
                //uprava komentare
                if (isset($request->comment_id)) {
                    $comment = Comment::where('id', $request->comment_id)->update(['content' => $request->content, 'updated_at' => now()]);

                }
                else {
                    //vytvareni noveho komentare
                    $newComment = Comment::updateOrCreate(
                    ['content' => $request->content,
                    'user_id'=> $request->user_id,
                    'post_id'=> $request->post_id,]);
                }
                break;
            default:
                dd($request);
                break;
        }
        return redirect()->back();
    }

    public function del(Request $request) {
        $user = User::findOrFail(Auth::user()->id);
        switch ($request->workingWith) {
            case 'group':
                Group::destroy($request->group_id);
                break;
            case 'post':
                Comment::where('post_id', $request->post_id)->delete();
                Post::destroy($request->post_id);
                break;
            case 'comment':
                Comment::destroy($request->comment_id);
                break;
            default:
                dd($request);
                break;
        }
        return redirect()->back();
    }

    public function join(Request $request) {
        $user = User::findOrFail(Auth::user()->id);
        try {
            $group_id = Group::where('invite_key', $request->invite_key)->get('id');
            $user->groups()->attach($group_id);
        }
        catch (Exception $e) {
            dd($e->getMessage());
        }
        return redirect()->back();
    }
}
