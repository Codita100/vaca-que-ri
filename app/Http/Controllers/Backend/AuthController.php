<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\Frontend\RegisterEmail;
use App\Mail\Frontend\ResetEmail;
use App\Models\Backend\Address;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function index(Request $request)

    {
        if (!$request->cookie('age_verification')) {
            return redirect()->route('age')->with('error', 'Você deve ter pelo menos 18 anos para se registrar.');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {

        $messages = [
            'email.required' => "O endereço de e-mail é obrigatório",
            'password.required' => 'Você não inseriu a senha.',
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
                return back()->with('error', 'Por favor, verifique se sua conta está ativa.');
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
                return back()->with('error', "Por favor, verifique suas credenciais.");
            }
        } else {
            return back()->with('error', "Por favor, verifique suas credenciais.");
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Você foi despejado');
    }


    public function store(Request $request)
    {
        if (!$request->cookie('age_verification')) {
            return redirect()->route('age')->with('error', 'Você deve ter pelo menos 18 anos para se registrar.');
        }


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

        $birthDay = new Address();
        $birthDay->user_id = $user->id;
        $birthDay->day = $request->cookie('day');
        $birthDay->month = $request->cookie('month');
        $birthDay->year = $request->cookie('year');
        $birthDay->accept_privacy = 1;
        $birthDay->accept_terms = 1;
        $birthDay->save();



        $user->assignRole('user');

        try {
            Mail::to($user->email)->send(new RegisterEmail($user->id, "Register User"));
        } catch (\Exception $e) {
            Log::info('Nu s-a trimis emailul pentru inregistrare');
        }
        return redirect()->route('login')->with('success', 'Um e-mail foi enviado para seu endereço para validar sua conta');
    }

    public function verify(Request $request, $token)
    {
        $user = User::where('token', $token)->first();

        if (!$user) {
            return redirect('/login')->with('error', 'O token de verificação não é válido.');
        }

        $timestampedToken = time() . '_' . Str::random(16);
        $user->token = $timestampedToken;
        $user->email_verified_at = Carbon::now();
        $user->save();

        return redirect()->route('login')->with('success', 'O email foi verificado com sucesso!');
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
        return redirect()->route('login')->with('success', 'Você receberá um e-mail com instruções de redefinição de senha');
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
            'password.required' => 'Senha requerida',
            'password.min' => 'A senha deve conter pelo menos 8 caracteres',
            'password.regex' => 'A senha deve conter 1 letra maiúscula, 1 número e 1 caractere especial',
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

        return redirect()->route('login')->with('success', 'Sua senha foi alterada com sucesso');
    }

    public function register(Request $request) {
        if (!$request->cookie('age_verification')) {
            return redirect()->route('age')->with('error', 'Você deve ter pelo menos 18 anos para se registrar.');
        }

        return view('auth.register');
    }

    public function age(){
        return view('auth.age');
    }

    public function ageRescrition(Request $request)
    {

        $rules = [
            'day' => 'required|numeric|min:1|max:31',
            'month' => 'required|numeric|min:1|max:12',
            'year' => 'required|numeric|max:2006|min:1900',
        ];

        $messages = [
            'day.required' => 'O campo dia é obrigatório.',
            'day.numeric' => 'O campo dia deve ser um número.',
            'day.min' => 'O campo dia deve ser no mínimo :min.',
            'day.max' => 'O campo dia não pode ser maior que :max.',
            'month.required' => 'O campo mês é obrigatório.',
            'month.numeric' => 'O campo mês deve ser um número.',
            'month.min' => 'O campo mês deve ser no mínimo :min.',
            'month.max' => 'O campo mês não pode ser maior que :max.',
            'year.required' => 'O campo ano é obrigatório.',
            'year.numeric' => 'O campo ano deve ser um número.',
            'year.max' => 'O campo ano não pode ser maior que :max.',
            'year.min' => 'Você deve ter pelo menos :min anos para se inscrever.',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $birthDay = Carbon::createFromFormat('d/m/Y', $request->day.'/'.$request->month.'/'.$request->year);
        $thisDay = Carbon::now();

        $age = $birthDay->diffInYears($thisDay);
        if ($age < 18) {
            return redirect()->back()->with('error', 'Você deve ter pelo menos 18 anos para se inscrever.');
        } else {

            return redirect()->route('participation.index')->withCookie(Cookie::make('age_verification', true, 60*24*30))
                ->withCookie(Cookie::make('day', $request->day, 60*24*30))
                ->withCookie(Cookie::make('month', $request->month, 60*24*30))
                ->withCookie(Cookie::make('year', $request->year, 60*24*30));
        }
    }

}
