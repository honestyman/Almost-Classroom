<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        try {
            return view('home', [
                'user' => $request->user()->with('groups')->withCount('groups')->first(),
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->back()->with('error', 'Něco se pokazilo.');
    }
}
