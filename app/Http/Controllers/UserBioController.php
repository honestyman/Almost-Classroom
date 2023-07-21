<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserBioController extends Controller
{
    public function update(Request $request, User $user)
    {
        $user->update([
            'bio' => $request->bio,
        ]);
        return redirect()->back();
    }
}
