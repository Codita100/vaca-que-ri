<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $orders;


    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    public function collection()
    {
        return $this->orders->map(function ($order) {
            return [
                'user' => $order->name,
                'email' => $order->email,
                'product ordered' => $order->product_name,
                'date' => $order->created_at,
            ];
        });
    }


    public function headings(): array
    {
        $headings = [
            'user',
            'email',
            'product ordered',
            'date',
        ];


        return $headings;
    }
}
