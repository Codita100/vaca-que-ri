<?php

namespace App\Http\Controllers\Backend;

use App\Exports\OrdersExport;
use App\Exports\PointsExport;
use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use App\Models\Backend\Campaign;
use App\Models\Backend\Order;
use App\Models\Backend\UserPointsIn;
use App\Models\Backend\UserPointsOut;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function index()
    {
        return view('backend.export.index');
    }


    public function exportPoints(Request $request)
    {
        if (!Auth::user()->hasRole('super_admin')) {
            return redirect()->back()->with('warning', 'Nu aveți permisiunea necesară pentru a accesa această funcționalitate.');
        }


        $users = User::get();

        foreach ($users as $user) {
            $user->total_accumulated_points = UserPointsIn::where('user_id', $user->id)->sum('accumulated_points');
            $user->total_consumed_points = UserPointsOut::where('user_id', $user->id)->sum('consumed_points');
            $user->remaining_points = $user->total_accumulated_points - $user->total_consumed_points;
        }

        if ($users->isNotEmpty()) {
            return Excel::download(new PointsExport($users), 'Raport_' . time() . '.xlsx');
        } else {
            return redirect()->back()->with('warning', 'Nu există raport în perioada selectată');
        }
    }

    public function exportOrders(Request $request)
    {
        if (!Auth::user()->hasRole('super_admin')) {
            return redirect()->back()->with('warning', 'Nu aveți permisiunea necesară pentru a accesa această funcționalitate.');
        }

        $orders = Order::join('users', 'orders.user_id', 'users.id')
            ->join('product_catalogs', 'orders.product_catalogs_id', 'product_catalogs.id')
            ->leftjoin('addresses', 'orders.id', 'addresses.order_id')
            ->select('users.id', 'users.name', 'users.email', 'product_catalogs.name as product_name', 'orders.created_at')
            ->get();

        if ($orders->isNotEmpty()) {
            return Excel::download(new OrdersExport($orders), 'Orders_' . time() . '.xlsx');
        } else {
            return redirect()->back()->with('warning', 'Nu există raport în perioada selectată');
        }
    }

}
