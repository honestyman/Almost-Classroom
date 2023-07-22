<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Str;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Group::class, 'group');
    }

    public function store(Request $request)
    {
        Group::make([
            'name' => $request->name,
            'public' => $request->public ? 1 : 0,
            'invite_key' => Str::random(10)
        ])->user()->associate(auth()->user())->save();
        if ($request->public) {
            foreach (User::all() as $user) {
                $user->groups()->attach(Group::latest()->first()->id);
            }
        } else {
            auth()->user()->groups()->attach(Group::latest()->first()->id);
        }
        return redirect()->back();
    }

    public function show(Group $group)
    {
        return view('group', [
            'group' => $group,
            'user' => User::where('id', auth()->id())->with('groups')->withCount('groups')->first()
        ]);
    }

    public function destroy(Group $group)
    {
        $group->delete();
        return redirect()->route('home');
    }
}
