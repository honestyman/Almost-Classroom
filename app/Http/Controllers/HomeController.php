<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index(Request $request) {
        //echo "<button><a href='/dashboard'>Dashboard</a></button>";
        //zobrazovani obsahu pouze ze skupin do kterych patri uzivatel
        $user = User::findOrFail(Auth::user()->id);
        /*
        foreach ($user->groups as $group) {
            echo "<div><h2>$group->name - $group->invite_key</h2>";
            $posts = Post::where('group_id', $group->id)->get();
            foreach ($posts as $post) {
                echo "<p><b>$post->name</b></p>";
                echo "<p><i>$post->content</i></p>";
                $comments = Comment::where('post_id', $post->id)->get();
                foreach ($comments as $comment) {
                    echo "<p><u>$comment->content</u></p>";
                }
            }
            echo "</div>";
        }*/
        $posts_final = array();
        $comments_final = array();
        foreach ($user->groups as $group) {
            $posts_final[] = (Post::where('group_id', $group->id)->get());
            $posts = Post::where('group_id', $group->id)->get();
                foreach ($posts as $post) {
                    $comments_final[] = Comment::where('post_id', $post->id)->get();
                    $comments = Comment::where('post_id', $post->id)->get();
                }
        };
        return view('dashboard', ['user' => $user, 'posts' => $posts_final, 'comments' => $comments_final]);
        
    }

    public function add(Request $request) {
        $user = User::findOrFail(Auth::user()->id);
        switch ($request->workingWith) {
            case 'group':
                $newGroup = Group::updateOrCreate(
                    ['name' => $request->name,
                    'user_id' => $request->user_id,
                    'invite_key' => Str::random(10)]);
                    $user->groups()->attach(Group::all()->count());
                break;
            case 'post':
                $newPost = Post::updateOrCreate(
                    ['name' => $request->name,
                    'content' => $request->content,
                    'group_id' => $request->group_id,
                    'user_id'=> $request->user_id,]);
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
        //return $this->index($request);
        return redirect()->back();
    }

    public function del(Request $request) {
        $user = User::findOrFail(Auth::user()->id);
        switch ($request->workingWith) {
            case 'group':
                Group::destroy($request->group_id);
                break;
            case 'post':
                Post::destroy($request->post_id);
                break;
            case 'comment':
                Comment::destroy($request->comment_id);
                break;
            default:
                dd($request);
                break;
        }
        return $this->index($request);
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
        return $this->index($request);
    }
}
