<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        echo "<button><a href='/dashboard'>Dashboard</a></button>";
        //zobrazovani obsahu pouze ze skupin do kterych patri uzivatel
      $user = User::find(Auth::user()->id);
      foreach ($user->groups as $group) {
        echo "<div><h2>$group->name - $group->invite_key</h2>";
        $posts = Post::where('group_id', $group->id)->get();
        foreach ($posts as $post) {
            echo "<p><b>$post->name</b></p>";
            echo "<p><i>$post->content</i></p>";
        }
        echo "</div>";
      }
    }

    public function add(Request $request) {
        $user = User::find(Auth::user()->id);
        if($request->group_id == "") {
            $newGroup = Group::updateOrCreate(
                ['name' => $request->name,
                'user_id' => $request->user_id,
                'invite_key' => Str::random(10)]);
                $user->groups()->attach(Group::all()->count());

        }
        else {
            $newPost = Post::updateOrCreate(
                ['name' => $request->name,
                'content' => $request->content,
                'group_id' => $request->group_id,
                'user_id'=> $request->user_id,]);
        }
        return $this->index($request);
    }

    public function join(Request $request) {
        $user = User::find(Auth::user()->id);
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
