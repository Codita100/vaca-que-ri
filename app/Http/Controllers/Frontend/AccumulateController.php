<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Address;
use App\Models\Backend\Cod;
use App\Models\Backend\UserPointsIn;
use App\Services\UserTransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccumulateController extends Controller
{
    public function index(){
        return view('frontend.accumulate.index');
    }

    public function store(Request $request)
    {
        $codul = $request->cod;
        $exist = Cod::where('cod', $codul)->first();
        if ($exist) {
            if ($exist->status == 0) {
                $exist->status = 1;
                $exist->save();

                $points = new UserPointsIn();
                $points->user_id = Auth::id();
                $points->code = $codul;
                $points->accumulated_points = $exist->product->points;
                $points->product_id = $exist->product->id;
                $points->save();

                UserTransactionService::insertTransaction(Auth::id(), $points->id);

                return redirect()->route('transactions.index')->with('success', 'Ok');
            } else {

                return redirect()->back()->with('info', 'Ups');
            }
        } else {
            $points = new UserPointsIn();
            $points->user_id = Auth::id();
            $points->code = $codul;
            $points->accumulated_points = 0;
            $points->product_id =null;
            $points->save();

            UserTransactionService::insertTransaction(Auth::id(), $points->id);
            return redirect()->back()->with('warning', 'Cod inexistent');
        }
    }
}
