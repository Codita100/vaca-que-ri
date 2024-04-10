<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Imports\CodesImport;
use App\Models\Backend\Cod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class CodesController extends Controller
{
    public function index()
    {
              return view('backend.codes.index');
    }

    public function getCodes(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'cod',
            2 => 'product_id',
            3 => 'status',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $dir = $request->input('order.0.dir');
        $orderColumnIndex = $request->input('order.0.column');
        $order = $columns[$orderColumnIndex] ?? 'created_at';


        $query = Cod::join('products', 'cod.product_id', '=', 'products.id')
            ->select('cod.id', 'cod.cod', 'cod.product_id',  'products.name as product_name',  'cod.status');

        $search = $request->input('search.value');
        if (!empty($search)) {
            $query->where(function ($subquery) use ($search) {
                $subquery->where('cod.cod', 'LIKE', "%{$search}%")
                    ->orWhere(function ($statusQuery) use ($search) {
                        $statuses = [
                            'Available' => Cod::AVAILABLE,
                            'Used' => Cod::USED,
                        ];

                        $statusId = $statuses[$search] ?? null;

                        if ($statusId !== null) {
                            $statusQuery->where('cod.status', $statusId);
                        }
                    })
                    ->orWhere('products.name', 'LIKE', "%{$search}%");
            });
        }


        $totalData = $query->count();
        $totalFiltered = $query->count();

        $query->orderBy($order, $dir);

        $codes = $query->offset($start)->limit($limit)->get();


        $data = [];
        foreach ($codes as $key => $cod) {
            $nestedData['id'] = $cod->id;
            $nestedData['cod'] = $cod->cod;
            $nestedData['product_id'] = $cod->product_name;

            $statusName = Cod::getStatusName($cod->status);
            switch (strtolower($statusName)) {
                case 'available': //0
                    $statusLabelClass = 'badge bg-success';
                    break;
                case 'used': // 1
                    $statusLabelClass = 'badge bg-warning';
                    break;
            }
            $nestedData['status'] = '<span class="' . $statusLabelClass . '">' . $statusName . '</span>';


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

    public function downloadModelCodes(){
        $modelExcelPath = public_path('excel/model_codes.xlsx');
        return response()->download($modelExcelPath, 'model_codes.xlsx');
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

        Excel::import(new CodesImport(), $request->file);
        return redirect()->back()->with($notification);
    }
}
