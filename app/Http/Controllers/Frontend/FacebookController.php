<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Address;
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
        return Socialite::driver($driver)->stateless()->redirect();
    }

    public function handleProviderCallback(Request $request, $driver)
    {

        try {
            $user = Socialite::driver($driver)->stateless()->setScopes(['email','openid'])->user();

        } catch (\Exception  $e) {
            return redirect()->route('login')->withError('Something went wrong! '.$e->getMessage());
        }

        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            auth()->login($existingUser, true);
        } else {
            $token = Str::random(16);
            while (User::where('token', $token)->exists()) {
                $token = Str::random(16);
            }
            $newUser = new User;
            $newUser->provider_name = $driver;
            $newUser->provider_id = $user->getId();
            $newUser->name = $user->getName();
            $newUser->email = $user->getEmail();
            $newUser->password = bcrypt(Str::random(16));
            // we set email_verified_at because the user's email is already veridied by social login portal
            $newUser->email_verified_at = now();
            $newUser->token = $token;
            $newUser->accept_privacy = 0;
            $newUser->accept_terms = 0;
            $newUser->save();

            $newUser->assignRole('user');

            $birthDay = new Address();
            $birthDay->user_id = $newUser->id;
            $birthDay->day = $request->cookie('day');
            $birthDay->month = $request->cookie('month');
            $birthDay->year = $request->cookie('year');

            $birthDay->save();


            auth()->login($newUser, true);
        }
        return redirect()->route('account.index');
    }
}
