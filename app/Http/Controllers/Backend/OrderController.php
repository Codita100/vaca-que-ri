<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Address;
use App\Models\Backend\Campaign;
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


class OrderController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $totalOrders = Order::all();
        return view('backend.orders.index', compact('totalOrders'));

    }

    public function getAllOrders(Request $request)
    {
        // Obține coloanele
        $columns = array(
            0 => 'id',
            1 => 'created_at',
            2 => 'user',
            3 => 'product_catalog',
            4 => 'status',
            5 => 'action',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $dir = $request->input('order.0.dir');
        $orderColumnIndex = $request->input('order.0.column');
        $order = $columns[$orderColumnIndex] ?? 'created_at';

        // Query pentru a obține datele
        $query = Order::leftjoin('addresses', 'orders.id', 'addresses.order_id')

        ->select(['orders.*']);


        // Aplică filtrarea pentru căutare
        $search = $request->input('search.value');
        if (!empty($search)) {
            $query->where(function ($subquery) use ($search) {
                $subquery->where('orders.created_at', 'LIKE', "%{$search}%");
            });
        }

        $totalData = $query->count();
        $totalFiltered = $query->count();

        $query->orderBy($order, $dir);

        // Limitează și offsetează rezultatele
        $orders = $query->offset($start)->limit($limit)->get();

        // Construiește array-ul de date pentru DataTables
        $data = [];
        foreach ($orders as $key => $order) {
            $nestedData['id'] = $order->id;
            $nestedData['created_at'] = $order->created_at->format('Y-m-d H:i:s');
            $nestedData['user'] = $order->user->name;
            $nestedData['product_catalog'] = $order->productCatalog->name;
            $nestedData['status'] = ($order->status == 0) ? 'Comanda plasata' : 'Comanda finalizata';
            $actions = '';
            $actions ='<a class="btn btn-primary waves-effect waves-light m-1" href="' . route('order.edit', $order->token) . '" title="Ai voie?"> Edit </a>';
            $actions .='<a class="btn btn-warning waves-effect waves-light m-1" href="' . route('order.delete', $order->token) . '" > Delete order </a>';

            $nestedData['action'] = $actions;

            $data[] = $nestedData;
        }

        // Construiește răspunsul JSON pentru DataTables
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );
        return response()->json($json_data);

    }


    public
    function show($token)
    {
        $order = Order::where('token', $token)->first();

        $totalOrderValue = $order->orderItems->sum(function ($item) {
            return $item->product->unit_price * $item->quantity;
        });

        $thresholdValue = $order->campaign->threshold;
        $difference = $thresholdValue - $totalOrderValue;


        return view('backend.orders.show', compact('order', 'totalOrderValue', 'thresholdValue', 'difference'));
    }

    public function edit($token)
    {
        $order = Order::where('token', $token)->first();

        if (!$order) {
            return redirect()->back()->with('error', 'Comanda nu a fost găsită.');
        }
        $products = ProductCatalog::get();
        return view('backend.orders.edit', compact('order', 'products'));
    }



    public
    function delete(Request $request, $token)
    {
        $order = Order::where('token', $token)->first();

        if ($order) {

            $order->delete();

            return redirect()->back()->with('success', 'Order and associated items deleted successfully');
        }

        return redirect()->back()->with('error', 'Order not found');
    }

    public function store($id){
        $product_catalog = ProductCatalog::findOrFail($id);
        $user = Auth::user();




        $total_points = UserPointsIn::where('user_id', $user->id)->sum('accumulated_points') - UserPointsOut::where('user_id', $user->id)->sum('consumed_points');
        if ($total_points >= $product_catalog->points) {

            $address = Address::where('user_id', $user->id)->first();

            if(!$address){
                return redirect()->route('address.index')->with('warning', 'Please insert the address.');
            }

            $product_catalog->stock = $product_catalog->stock - 1;
            $product_catalog->save();

            $points = new UserPointsOut();
            $points->user_id = Auth::id();
            $points->consumed_points = $product_catalog->points;
            $points->product_catalogs_id  = $product_catalog->id;
            $points->save();

            do {
                $token = Str::random(10);
            } while (Order::where('token', $token)->exists());

            $order = new Order();
            $order->user_id = Auth::id();
            $order->token = $token;
            $order->product_catalogs_id = $product_catalog->id;
            $order->save();

            return redirect()->back()->with('success', 'Ai cumparat ce trebuie');

        }else{
            return redirect()->back()->with('error', 'Nu ai suficiente puncte pentru a cumpăra acest produs.');
        }
    }
}
