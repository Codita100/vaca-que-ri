<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Order;
use App\Models\Backend\ProductCatalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class MyAccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $accumulatedPoints = $user->points_in->sum('accumulated_points');
        $consumedPoints = $user->points_out->sum('consumed_points');
        $totalPoints = $accumulatedPoints - $consumedPoints;

        $minutes = 60;
        $prizes = Cache::remember('prizes', $minutes, function () {
            return ProductCatalog::with('multiImages')->get();
        });


        return view('frontend.account.index', compact('totalPoints', 'prizes'));
    }

    public function indexAddress()
    {
        return view('frontend.account.address');
    }
}
