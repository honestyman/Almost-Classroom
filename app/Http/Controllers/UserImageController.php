<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserImageController extends Controller
{
    public function update(Request $request, User $user)
    {
        if ($request->hasFile('image')) {
            $filename = $user->id . $request->image->getClientOriginalName();
            $request->image->storeAs('images', $filename, 'public');
            $user->update([
                'image' => $filename,
            ]);
        }
        return redirect()->back();
    }
}
