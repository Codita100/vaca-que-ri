<?php

namespace App\Imports;

use App\Models\Backend\Campaign;
use App\Models\Backend\Cod;
use App\Models\Backend\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CodesImport implements ToCollection, WithHeadingRow
{

    private $product_id;
    public function __construct($product_id)
    {
        $this->product_id = $product_id;
    }
    public function collection(Collection $collection)
    {
        $codesImported = 0;

        foreach ($collection as $row) {

            $new_code = new Cod;
            $new_code->cod = $row['code'];
            $new_code->product_id = $this->product_id;
            $new_code->status = 0;
            $new_code->save();
            $codesImported++;
        }

        return redirect()->back()->with('warning', $codesImported . " codes imported");
    }
}
