<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function redirectToProvider()
    {
        return Socialite::with('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $socialUser = Socialite::driver('facebook')->user();
        /** @var User $user */
        $user = User::firstOrCreate([
            'email'       => $socialUser->getEmail(),
            'provider_id' => $socialUser->getId(),
            'provider'    => 'facebook',
        ], [
            'name'     => $socialUser->getName(),
            'avatar'   => $socialUser->getAvatar(),
            'password' => bcrypt(Str::random(20)),
        ]);

        if (!$user->wasRecentlyCreated) {
            $user->update([
                'name'   => $socialUser->getName(),
                'avatar' => $socialUser->getAvatar(),
            ]);
        }

        Auth::login($user);

        return redirect()->route('home');
    }
}
