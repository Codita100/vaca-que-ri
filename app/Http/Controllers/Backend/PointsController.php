<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\UserPoints;
use App\Models\Backend\UserPointsIn;
use App\Models\Backend\UserTransaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PointsController extends Controller
{
    public function index()
    {
        $users = User::with('points_in')->get();
        return view('backend.points.index', compact('users'));
    }

    public function view($id)
    {
        $user = User::findOrFail($id);
        if ($user) {

            $transactions = UserTransaction::all();
            return view('backend.points.show', compact('transactions'));

        } else {
            return redirect()->back()->with('warning', 'User not found');
        }
    }

    public function getAllTransactions(Request $request)
    {
        // Obține coloanele
        if ($request->ajax()) {
            $columns = array(
                0 => 'id',
                1 => 'user',
                2 => 'email',
                3 => 'points',
            );


            $limit = $request->input('length');
            $start = $request->input('start');
            $dir = $request->input('order.0.dir');
            $orderColumnIndex = $request->input('order.0.column');
            $order = $columns[$orderColumnIndex] ?? 'created_at';

            $query = User::with('points_in')->select('users.*');


            $search = $request->input('search.value');
            if (!empty($search)) {
                $query->where(function ($subquery) use ($search) {
                    $subquery->where('users.name', 'LIKE', "%{$search}%")
                        ->orWhere('users.email', 'LIKE', "%{$search}%");
                });
            }

            $totalData = $query->count();
            $totalFiltered = $query->count();
            $query->orderBy($order, $dir);
            $users = $query->offset($start)->limit($limit)->get();

            // Construiește array-ul de date pentru DataTables
            $data = [];
            foreach ($users as $key => $user) {
                $accumulatedPoints = $user->points_in->sum('accumulated_points');
                $consumedPoints = $user->points_out->sum('consumed_points');
                $totalPoints = $accumulatedPoints - $consumedPoints;

                $nestedData['id'] = $user->id;
                $nestedData['user'] = $user->name;
                $nestedData['points'] = $totalPoints;
                $nestedData['email'] = $user->email;
                $data[] = $nestedData;
            }

            $json_data = array(
                "draw" => intval($request->input('draw')),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data,
            );

            return response()->json($json_data);
        }

        return view('backend.points.index');
    }
}
