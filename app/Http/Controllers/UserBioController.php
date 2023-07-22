<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserBioController extends Controller
{
    public function update(Request $request, User $user)
    {
        $user->update($request->validate([
            'bio' => 'required|string|max:256'
        ]));
        return redirect()->back();
    }
}
