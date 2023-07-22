<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Exception;

class UserController extends Controller
{
    public function show(User $user)
    {
        try {
            return view('user', [
                'user' => $user,
                'private_group_count' => $user->groups()->where('public', 1)->count(),
                'finished_post_count' => $user->postusers()->where('finished', 1)->count(),
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->back()->with('error', 'Něco se pokazilo.');
    }
}
