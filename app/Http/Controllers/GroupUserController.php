<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

class GroupUserController extends Controller
{
    public function index(Group $group)
    {
        try {
            return view('users', ['group' => $group->with('users')]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->back()->with('error', 'Něco se pokazilo.');
    }

    public function store(Request $request)
    {
        try {
            $group_id = Group::where('invite_key', $request->invite_key)->get('id');
            auth()->user()->groups()->attach($group_id);
            return redirect()->back()->with('success', 'Úspěšně jste se připojili do skupiny.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->back()->with('error', 'Něco se pokazilo.');
    }
}
