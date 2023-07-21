<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;


class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        $finduser = User::where('google_id', $user->id)->first();
        if ($finduser) {
            Auth::login($finduser);
            return redirect()->route('home');
        } else {
            $user = User::updateOrCreate(['email' => $user->email], [
                'name' => $user->name,
                'google_id' => $user->id,
                'password' => encrypt('123456dummy')
            ]);
            foreach (Group::where('public', "1")->get() as $group) {
                $user->groups()->attach($group->id);
            }
            Auth::login($user);
            return redirect()->route('home');
        }
    }
}
