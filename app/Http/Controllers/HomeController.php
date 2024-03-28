<?php

namespace App\Http\Controllers;

use App\Models\Backend\Campaign;
use App\Models\Backend\Cod;
use App\Models\Backend\Order;
use App\Models\Backend\ProductCatalog;
use App\Models\Backend\UserPoints;
use App\Models\Backend\UserPointsIn;
use App\Models\Backend\UserPointsOut;
use App\Models\Backend\UserTransaction;
use App\Services\UserTransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        dd('hahaaaa');
        return redirect()->route('login');
    }

    public function introdu_cod()
    {
        return view('frontend.test.introdu_cod');
    }

    public function introdu_cod_post(Request $request)
    {
        $codul = $request->cod;
        $exist = Cod::where('cod', $codul)->first();
        if ($exist) {
            if ($exist->status == 0) {
                $exist->status = 1;
                $exist->save();

                $points = new UserPointsIn();
                $points->user_id = Auth::id();
                $points->accumulated_points = $exist->product->points;
                $points->product_id = $exist->product->id;
                $points->save();

                UserTransactionService::insertTransaction(Auth::id(), $points->id);

                return redirect()->back()->with('success', 'Cod înregistrat cu succes');
            } else {
                return redirect()->back()->with('info', 'Codul a fost deja înregistrat');
            }
        } else {
            return redirect()->back()->with('warning', 'Cod inexistent');
        }
    }

    public function cheltuie_puncte(){

        $products = ProductCatalog::get();
        return view('frontend.test.cheltuie_puncte', compact('products'));
    }


}
