<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PointsExport implements FromCollection, WithHeadings

{
    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function collection()
    {
        return $this->users->map(function ($users) {

            $data = [
                'User' => $users->name,
                'Email' => $users->email,
                'Accumulated Points' => $users->total_accumulated_points? $users->total_accumulated_points : '0',
                'Consumed Points' => $users->total_consumed_points? $users->total_consumed_points : '0',
                'Remaining Points' => $users->remaining_points? $users->remaining_points : '0',

            ];

            return $data;
        });
    }

    public function headings(): array
    {
        $headings = [
            'User',
            'Email',
            'Accumulated Points',
            'Consumed Points',
            'Remaining Points',
        ];


        return $headings;
    }
}
