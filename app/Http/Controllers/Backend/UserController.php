<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Imports\SalesForce;
use App\Models\Backend\Campaign;
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
        return view('backend.users.index', compact('users', ));
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
            $actions ='<a class="btn btn-primary waves-effect waves-light m-1" href="' . route('users.impersonate', $user->id) . '" title="Ai voie?"> Impresonate </a>';
            $actions .='<a class="btn btn-warning waves-effect waves-light m-1" href="' . route('users.all.about', $user->id) . '" > View </a>';

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
        $salesForce = User::find($id);
        return view('backend.users.edit', compact('salesForce'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($id),
            ],
        ]);

        $salesForce = User::find($id);
        $salesForce->firstname = $request->firstname;
        $salesForce->lastname = $request->lastname;
        $salesForce->email = $request->email;
        $salesForce->save();

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
        return view('backend.users.all_about_user', compact('user', 'orders', 'totalPoints'));
    }
}
