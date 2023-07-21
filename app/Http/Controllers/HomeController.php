<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user()->with('groups')->withCount('groups')->first();
        return view('home', [
            'user' => $user,
        ]);
    }
}
