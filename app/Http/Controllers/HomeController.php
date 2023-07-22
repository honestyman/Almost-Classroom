<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('home', [
            'user' => $request->user()->with('groups')->withCount('groups')->first(),
        ]);
    }
}
