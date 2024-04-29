<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Imports\SalesForce;
use App\Models\Backend\Address;
use App\Models\Backend\Campaign;
use App\Models\Backend\Order;
use App\Models\Backend\UserTransaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('backend.users.index', compact('users',));
    }

    public function getAllUsers(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'created_at',
            2 => 'name',
            3 => 'email',
            4 => 'status',
            5 => 'roles',
            6 => 'action',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $dir = $request->input('order.0.dir');
        $orderColumnIndex = $request->input('order.0.column');
        $order = $columns[$orderColumnIndex] ?? 'created_at';

        $query = User::select(['users.*']);
        $search = $request->input('search.value');


        if (!empty($search)) {
            $query->where(function ($subquery) use ($search) {
                $subquery->where('users.name', 'LIKE', "%{$search}%");
            });
        }

        $totalData = $query->count();
        $totalFiltered = $query->count();

        $query->orderBy($order, $dir);
        $users = $query->offset($start)->limit($limit)->get();

        $data = [];
        foreach ($users as $key => $user) {
            $nestedData['id'] = $user->id;
            $nestedData['name'] = $user->name;
            $nestedData['created_at'] = $user->created_at->format('Y-m-d H:i:s');
            $nestedData['email'] = $user->email;
            //status
            $statusClass = $user->email_verified_at ? 'bg-success' : 'bg-danger';
            $statusText = $user->email_verified_at ? 'Activ' : 'Inactiv';
            $nestedData['status'] = '<span class="badge ' . $statusClass . '">' . $statusText . '</span>';
            $roles = $user->roles()->pluck('name')->implode(', ');
            $nestedData['roles'] = $roles;

            $actions = '';
            if (Auth::user()->hasRole('super_admin')) {
                $actions .= '<a class="btn btn-primary waves-effect waves-light m-1" href="' . route('users.impersonate', $user->id) . '" title="Ai voie?"> Impersonate </a>';
            }


            $actions .= '<a class="btn btn-warning waves-effect waves-light m-1" href="' . route('users.all.about', $user->id) . '" > View </a>';
            $actions .= '<a class="btn btn-primary waves-effect waves-light m-1" href="' . route('users.edit', $user->id) . '" > Edit </a>';

            $nestedData['action'] = $actions;
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

    public function edit($id)
    {
        $user = User::find($id);
        return view('backend.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        $user = User::find($id);
        $address = $user->address;

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->has('active')) {
            $user->email_verified_at = now();
        } else {
            $user->email_verified_at = null;
        }
        $user->save();

        if ($address) {
            $address->address = $request->address;
            $address->phone = $request->phone;
            $address->city = $request->city;
            $address->postal = $request->postal;
            $address->code = $request->code;
            $address->save();
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }


    public function import(Request $request)
    {
        set_time_limit(1200);
        if ($request['file'] == "") {
            return back()->with('error', 'Incarca un fisier excel');
        }

        $notification = array(
            'message' => 'Fisier uploadat cu success',
            'alert-type' => 'success'
        );

        Excel::import(new SalesForce(), $request->file);
        return redirect()->back()->with($notification);
    }

    public function impersonate($id)
    {
        if (Auth::user()->hasRole('super_admin')) {
            $user = User::find($id);
            Auth::login($user);
        }
        return redirect()->route('account.index');
    }

    public function allAbout($id)
    {
        $user = User::find($id);
        $orders = UserTransaction::where('user_id', $id)->get();
        $accumulatedPoints = $user->points_in->sum('accumulated_points');
        $consumedPoints = $user->points_out->sum('consumed_points');
        $totalPoints = $accumulatedPoints - $consumedPoints;

        $catalog_orders = Order::where('user_id', $user->id)->get();
        return view('backend.users.all_about_user', compact('user', 'orders', 'totalPoints', 'catalog_orders'));
    }
}
