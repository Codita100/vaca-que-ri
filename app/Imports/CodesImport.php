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
    public function collection(Collection $collection)
    {
        $codesImported = 0;
        $codesNotImported = 0;

        foreach ($collection as $row) {

            if (empty($row['code'])) {
                Log::error('Rând invalid...');
                $codesNotImported++;
                continue;
            }

            if (Cod::whereRaw('BINARY cod REGEXP ?', $row['code'])->exists()) {
                Log::error('Există deja codul in baza ' . $row['code'] );
                $codesNotImported++;
                continue;
            }


            $product = Product::find($row['productid']);


            if ($product) {
                $new_code = new Cod;
                $new_code->cod = $row['code'];
                $new_code->product_id = $row['productid'];
                $new_code->status = 0;
                $new_code->save();
                $codesImported++;
            } else {
                Log::error('The product with id ' . $row['productid'] . ' doesnt exist.');
                $codesNotImported++;
            }
        }

        return redirect()->back()->with('warning', $codesImported . " codes imported, " . $codesNotImported . " codes not imported");
    }
}
