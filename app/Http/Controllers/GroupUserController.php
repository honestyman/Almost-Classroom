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
        return view('users', ['group' => $group->with('users')]);
    }

    public function store(Request $request)
    {
        try {
            $group_id = Group::where('invite_key', $request->invite_key)->get('id');
            auth()->user()->groups()->attach($group_id);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->back();
    }
}
