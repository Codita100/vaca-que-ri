<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Address;
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
        $prizes = ProductCatalog::with('multiImages')->get();

        foreach ($prizes as $prize) {
            $prize->userProductCount = Order::getProductCountForUser(Auth::id(), $prize->id);
        }


        return view('frontend.account.index', compact('totalPoints', 'prizes'));
    }

    public function indexAddress()
    {
        return view('frontend.account.address');
    }

    public function storeAddress(Request $request){
        $validatedData = $request->validate([
            'street_address' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
        ]);


        $address = new Address();
        $address->user_id = auth()->id();
        $address->street_address = $validatedData['street_address'];
        $address->number = $validatedData['number'];
        $address->city = $validatedData['city'];
        $address->postal_code = $validatedData['postal_code'];
        $address->save();

        return redirect()->back()->with('success', 'Address saved successfully!');
    }
}
