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
      $user = User::find(1);
      $user_id = Auth::user()->id;
      
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
}
