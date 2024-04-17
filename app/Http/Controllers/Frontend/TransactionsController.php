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
       $user = Auth::user();
       $accumulatedPoints = $user->points_in->sum('accumulated_points');
       $consumedPoints = $user->points_out->sum('consumed_points');
       $totalPoints = $accumulatedPoints - $consumedPoints;

       $transactions = UserPointsIn::where(['user_id'=> Auth::id()])->get();
       return view('frontend.transactions.index', compact('transactions', 'totalPoints'));
   }
}
