<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class UserImageController extends Controller
{
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        try {
            if ($request->hasFile('image')) {
                $filename = $user->id . $request->image->getClientOriginalName();
                $request->image->storeAs('images', $filename, 'public');
                $user->update([
                    'image' => $filename,
                ]);
            }
            return redirect()->back()->with('success', 'Obrázek byl úspěšně změněn.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->back()->with('error', 'Něco se pokazilo.');
    }
}
