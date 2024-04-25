<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Address;
use App\Models\Backend\Cod;
use App\Models\Backend\UserPointsIn;
use App\Services\UserTransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AccumulateController extends Controller
{
    public function index(){
        return view('frontend.accumulate.index');
    }

    public function store(Request $request)
    {
        $messages = [
            'cod.required' => 'O campo do código é obrigatório.',
            'cod.string' => 'O campo do código deve ser uma string.',
            'cod.max' => 'O campo do código não pode ter mais de :max caracteres.',
        ];

        $validator = Validator::make($request->all(), [
            'cod' => 'required|string|max:255',
        ], $messages);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $codul = strip_tags($request->cod);

        $exist = Cod::where('cod', $codul)->first();

        if ($exist) {
            if ($exist->status == 0) {
                $exist->status = 1;
                $exist->save();

                $points = new UserPointsIn();
                $points->user_id = Auth::id();
                $points->code_id = $exist->id;
                $points->code = $codul;
                $points->accumulated_points = $exist->product->points;
                $points->product_id = $exist->product->id;
                $points->save();

                UserTransactionService::insertTransaction(Auth::id(), $points->id);

                return redirect()->back()->with('success_modal', 'O código foi salvo com sucesso');
            } else {
                $points = new UserPointsIn();
                $points->user_id = Auth::id();
                $points->code = $codul;
                $points->accumulated_points = 0;
                $points->product_id =null;
                $points->save();

                UserTransactionService::insertTransaction(Auth::id(), $points->id);

                return redirect()->back()->with('warning_modal', 'O código está incorreto.');
            }
        } else {
            $points = new UserPointsIn();
            $points->user_id = Auth::id();
            $points->code = $codul;
            $points->accumulated_points = 0;
            $points->product_id =null;
            $points->save();

            UserTransactionService::insertTransaction(Auth::id(), $points->id);
            return redirect()->back()->with('warning_modal', 'O código está incorreto.');
        }
    }
}
