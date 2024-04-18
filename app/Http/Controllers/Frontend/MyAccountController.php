<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Address;
use App\Models\Backend\Order;
use App\Models\Backend\ProductCatalog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MyAccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $accumulatedPoints = $user->points_in->sum('accumulated_points');
        $consumedPoints = $user->points_out->sum('consumed_points');
        $totalPoints = $accumulatedPoints - $consumedPoints;
        $prizes = ProductCatalog::with('multiImages')->get();

        foreach ($prizes as $prize) {
            $prize->userProductCount = Order::getProductCountForUser(Auth::id(), $prize->id);
        }


        return view('frontend.account.index', compact('totalPoints', 'prizes'));
    }

    public function indexAddress()
    {
        $user = Auth::user();
        return view('frontend.account.address', compact('user'));
    }

    public function storeAddress(Request $request)
    {

        $rules = [
            'name' => 'required|string|max:255',
            'day' => 'required|numeric|min:1|max:31',
            'month' => 'required|numeric|min:1|max:12',
            'year' => 'required|numeric|max:2006',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal' => 'required|regex:/^[0-9]{4}/',
            'code' => 'required|regex:/^[0-9]{3}/',
            'accept_privacy' => 'required|accepted',
            'accept_terms' => 'required|accepted',
        ];

        $messages = [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome não pode ter mais de :max caracteres.',
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
            'year.min' => 'Você deve ter pelo menos 18 anos para se inscrever.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo email deve ser um endereço de email válido.',
            'email.max' => 'O campo email não pode ter mais de :max caracteres.',
            'phone.required' => 'O campo telefone é obrigatório.',
            'phone.string' => 'O campo telefone deve ser uma string.',
            'phone.max' => 'O campo telefone não pode ter mais de :max caracteres.',
            'address.required' => 'O campo morada é obrigatório.',
            'address.string' => 'O campo morada deve ser uma string.',
            'address.max' => 'O campo morada não pode ter mais de :max caracteres.',
            'accept_privacy.required' => 'Você deve aceitar o tratamento dos seus dados pessoais.',
            'accept_privacy.accepted' => 'Você deve aceitar o tratamento dos seus dados pessoais.',
            'accept_terms.required' => 'Você deve aceitar o regulamento da campanha.',
            'accept_terms.accepted' => 'Você deve aceitar o regulamento da campanha.',
            'postal.required' => 'O campo código postal é obrigatório.',
            'postal.regex' => 'O formato do código postal está incorreto. Deve conter exatamente 4 dígitos.',
            'code.required' => 'O campo código é obrigatório.',
            'code.regex' => 'O formato do código está incorreto. Deve conter exatamente 3 dígitos.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $birthDay = Carbon::createFromFormat('d/m/Y', $request->day . '/' . $request->month . '/' . $request->year);
        $thisDay = Carbon::now();

        $age = $birthDay->diffInYears($thisDay);
        if ($age < 18) {
            return redirect()->back()->with('error', 'Você deve ter pelo menos 18 anos para participar.');
        }

        $user = Auth::user();

        $address = Address::where('user_id', $user->id)->first();
        if (!$address) {
            $address = new Address();
        }
        $address->user_id = $user->id;
        $address->phone = $request->phone;
        $address->day = $request->input('day');
        $address->month = $request->input('month');
        $address->year = $request->input('year');

        $address->address = $request->input('address');
        $address->city = $request->input('city');
        $address->postal = $request->input('postal');
        $address->code = $request->input('code');
        $address->accept_privacy =  $request->input('accept_privacy') ? 1 : 0;
        $address->accept_terms = $request->input('accept_terms') ? 1 : 0;
        $address->save();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success', 'Endereço salvo com sucesso!');
    }
}
