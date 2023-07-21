<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        return view('user', [
            'user' => $user,
            'private_group_count' => $user->groups()->where('public', 1)->count(),
            'finished_post_count' => $user->postusers()->where('finished', 1)->count(),
        ]);
    }
}
