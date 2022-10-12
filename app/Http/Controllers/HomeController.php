<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        //zobrazovani obsahu pouze ze skupin do kterych patri uzivatel
      $user = User::find(Auth::user()->id);
      foreach ($user->groups as $group) {
        echo "<div><h2>$group->name</h2>";
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
                'user_id'=> $request->user_id,]);
                $user->groups()->attach(Group::all()->count());
                //$user->roles()->attach($roleId);

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
}
