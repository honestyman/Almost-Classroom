<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user()->id;
        $groups = Group::where('user_id', $user)->get();
        foreach ($groups as $group) {
            echo $group->name;
        }
        
    }
}
