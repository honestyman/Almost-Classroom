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
            return view('app.home.index', [
                'user' => $request->user(),
                'groups' => $request->user()->groups,
                'group_count' => $request->user()->groups()->count(),
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->back()->with('error', 'Něco se pokazilo.');
    }
}
