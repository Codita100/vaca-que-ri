<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\UserPoints;
use App\Models\Backend\UserPointsIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
   public function index(){
       $transactions = UserPointsIn::where(['user_id'=> Auth::id()])->get();
       return view('frontend.transactions.index', compact('transactions'));
   }
}
