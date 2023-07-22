<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Exception;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Group::class, 'group');
    }

    public function store(Request $request)
    {
        try {
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
            return redirect()->back()->with('success', 'Skupina byla úspěšně přidána.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->back()->with('error', 'Něco se pokazilo.');
    }

    public function show(Group $group)
    {
        try {
            return view('app.group.index', [
                'group' => $group,
                'user' => User::where('id', auth()->id())->with('groups')->withCount('groups')->first()
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->back()->with('error', 'Něco se pokazilo.');
    }

    public function destroy(Group $group)
    {
        try {
            $group->delete();
            return redirect()->route('home')->with('success', 'Skupina byla úspěšně smazána.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->back()->with('error', 'Něco se pokazilo.');
    }
}
