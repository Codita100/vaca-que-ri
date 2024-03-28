<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\Backend\ResetEmail;
use App\Mail\Frontend\RegisterEmail;
use App\Models\Backend\Campaign;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $messages = [
            'email.required' => 'Adresa de email este obligatorie',
            'password.required' => 'Nu ai introdus parola',
        ];

        $validator = Validator::make($request->all(),
            [
                'email' => 'required',
                'password' => 'required',
            ], $messages);


        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('email', '=', $request['email'])->first();

        if ($user) {
            if ($user->email_verified_at == null) {
                return back()->with('error', 'Te rugam verifica daca ai contul activ');
            }

            //check for password
            if (Hash::check($request['password'], $user->password)) {
                Auth::login($user);
                if (Auth::user()->hasRole(['super_admin', 'admin'])) {
                    return redirect()->route('backend.index');
                } else {
                    return redirect()->route('account.index');
                }
            } else {
                return back()->with('error', 'Te rugam sa verifici credentialele');
            }
        } else {
            return back()->with('error', 'Te rugam sa verifici credentialele');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Ai fost delogat');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
            'accept_privacy' => 'required|accepted',
            'accept_terms' => 'required|accepted',
        ]);

        if ($validator->fails()) {
            return redirect('register')
                ->withErrors($validator)
                ->withInput();
        }

        do {
            $token = Str::random(16);
        } while (User::where('token', $token)->exists());



        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        $user->token = $token;
        $user->save();


        $user->assignRole('user');

        try {
            Mail::to($user->email)->send(new RegisterEmail($user->id, "Register User"));
        } catch (\Exception $e) {
            Log::info('Nu s-a trimis emailul pentru inregistrare');
        }
        return redirect()->route('login')->with('success', 'Un email a fost trimit catre adresa ta pentru a valida contul');
    }

    public function verify(Request $request, $token)
    {
        $user = User::where('token', $token)->first();

        if (!$user) {
            return redirect('/login')->with('error', 'Tokenul de verificare nu este valid.');
        }

        $timestampedToken = time() . '_' . Str::random(16);
        $user->token = $timestampedToken;
        $user->email_verified_at = Carbon::now();
        $user->save();

        return redirect()->route('home')->with('success', 'Emailul a fost verificat cu succes!');
    }

    public function forgotPassword()
    {
        return view('auth.forgot_password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $user = User::where(['email' => $request->email])->first();
        if ($user) {
            try {
                Mail::to($user->email)->send(new ResetEmail($user->id, "Reset Password"));
            } catch (\Exception $e) {
                Log::info('Nu s-a trimis emailul pentru resetarea parolei');
            }
        }
        return redirect()->route('login')->with('success', 'Vei primit un email cu instructiunile de resetare a parolei');
    }

    public function resetPasswordPage($token)
    {
        $user = User::where('token', '=', $token)->first();
        if ($user) {
            return view('auth.reset_password', compact('token', 'user'));
        } else {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Link expired');
        }
    }

    public function updatePassword(Request $request)
    {
        $user = User::where('token', '=', $request->token)->first();

        $messages = [
            'password.required' => 'Parola este obligatorie',
            'password.min' => 'Parola trebuie sa contina minim 8 caractere',
            'password.regex' => 'Parola trebuie sa contina 1 litera mare, 1 numar si 1 caracter special',
        ];

        $validator = Validator::make($request->all(),
            [
                'password' => 'min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|required',
                'password_confirmation' => 'same:password',
            ], $messages);


        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->password = bcrypt($request['password']);
        $user->token = Str::random(16);
        $user->email_verified_at = Carbon::now();
        $user->save();

        return redirect()->route('login')->with('success', 'Parola ta a fost schimbata cu succes');
    }

    public function register(){
        return view('auth.register');
    }


}
