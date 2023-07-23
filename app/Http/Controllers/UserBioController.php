<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class UserBioController extends Controller
{
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        try {
            $user->update($request->validate([
                'bio' => 'required|string|max:256'
            ]));
            return redirect()->back()->with('success', 'Popisek byl úspěšně změněn.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->back()->with('error', 'Něco se pokazilo.');
    }
}
