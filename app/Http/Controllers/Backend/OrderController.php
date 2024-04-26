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
        return view('backend.orders.index');

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

        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $dir = $request->input('order.0.dir');
        $orderColumnIndex = $request->input('order.0.column');
        $order = $columns[$orderColumnIndex] ?? 'created_at';

        $query = Order::leftjoin('addresses', 'orders.user_id', 'addresses.user_id')
            ->select(['orders.*']);


        $search = $request->input('search.value');
        if (!empty($search)) {
            $query->where(function ($subquery) use ($search) {
                $subquery->where('orders.created_at', 'LIKE', "%{$search}%");
            });
        }

        $totalData = $query->count();
        $totalFiltered = $query->count();

        $query->orderBy($order, $dir);

        $orders = $query->offset($start)->limit($limit)->get();


        $data = [];
        foreach ($orders as $key => $order) {
            $nestedData['id'] = $order->id;
            $nestedData['created_at'] = $order->created_at->format('Y-m-d H:i:s');
            $nestedData['user'] = $order->user->name;
            $nestedData['product_catalog'] = $order->productCatalog->name;
            $nestedData['status'] = ($order->status == 0) ? 'Order' : 'Comanda finalizata';

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


}
