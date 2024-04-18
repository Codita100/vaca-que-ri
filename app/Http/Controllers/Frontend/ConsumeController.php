<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\Frontend\OrderEmail;
use App\Models\Backend\Address;
use App\Models\Backend\Order;
use App\Models\Backend\ProductCatalog;
use App\Models\Backend\UserPointsIn;
use App\Models\Backend\UserPointsOut;
use App\Services\UserTransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ConsumeController extends Controller
{
    public function index()
    {
        $products = ProductCatalog::get();
        return view('frontend.consume.index', compact('products'));
    }

    public function store($id)
    {
        $product_catalog = ProductCatalog::findOrFail($id);
        $user = Auth::user();

        $total_points = UserPointsIn::where('user_id', $user->id)->sum('accumulated_points') - UserPointsOut::where('user_id', $user->id)->sum('consumed_points');

        //check 1 - Number of points
        if ($total_points >= $product_catalog->points) {

            //check 2 - Address
            $address = Address::where('user_id', $user->id)->first();
            if (!$address->address) {
                return redirect()->route('address.index')->with('warning', 'Por favor, insira o endereço.');
            }

            $product_catalog->stock = $product_catalog->stock - 1; // stock
            $product_catalog->save();

            $points = new UserPointsOut();
            $points->user_id = Auth::id();
            $points->consumed_points = $product_catalog->points;
            $points->product_catalogs_id = $product_catalog->id;
            $points->save();

            do {
                $token = Str::random(10);
            } while (Order::where('token', $token)->exists());

            $order = new Order();
            $order->user_id = Auth::id();
            $order->token = $token;
            $order->product_catalogs_id = $product_catalog->id;
            $order->save();

            UserTransactionService::insertOutTransaction(Auth::id(), $points->id);

            try {
                Mail::to($user->email)->send(new OrderEmail($user->id, $order,  "Order"));
            } catch (\Exception $e) {
                Log::info('Nu s-a trimis emailul pentru comanda');
            }

            return redirect()->back()->with('success_order', 'Você comprou o que era necessário.');

        } else {
            return redirect()->back()->with('error', 'Você não tem pontos suficientes.');
        }
    }
}
