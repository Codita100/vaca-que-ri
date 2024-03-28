<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FacebookController extends Controller
{
    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function handleProviderCallback($driver)
    {

        try {
            $user = Socialite::driver($driver)->user();

        } catch (\Exception $e) {
            return redirect()->route('login');
        }
        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            auth()->login($existingUser, true);
            return 'yeiii';
        } else {
            $token = Str::random(16);
            while (User::where('token', $token)->exists()) {
                $token = Str::random(16);
            }
            $newUser = new User;
            $newUser->provider_name = $driver;
            $newUser->provider_id = $user->getId();
            $newUser->lastname = $user->getName();
            $newUser->firstname = $user->getName();
            $newUser->email = $user->getEmail();
            $newUser->password = bcrypt(Str::random(16));
            // we set email_verified_at because the user's email is already veridied by social login portal
            $newUser->email_verified_at = now();
            $newUser->token = $token;

            $newUser->save();
            auth()->login($newUser, true);
        }
        return redirect()->route('home');
    }
}
