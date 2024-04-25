<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CodesExport implements  FromCollection, WithHeadings
{
    protected $codes;


    public function __construct($codes)
    {
        $this->codes = $codes;
    }

    public function collection()
    {
        return $this->codes->map(function ($codes) {
            return [
                'cod' => $codes->cod,
                'user' => $codes->userName,
                'product' => $codes->product->name,
                'catalog_product' => $codes->catalog_product ? $codes->catalog_product : '-',

            ];
        });
    }


    public function headings(): array
    {
        $headings = [
            'cod',
            'user',
            'product',
            'catalog_product',
        ];


        return $headings;
    }
}
