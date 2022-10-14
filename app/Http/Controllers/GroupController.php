<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends Controller
{
    public function show(Request $request) {
        $group = Group::findOrFail($request->id);
        return view('group', ['site' => $group]);
    }
}
