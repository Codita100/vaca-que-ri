<?php

namespace Database\Seeders;

use App\Models\Backend\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Produs 1',
            'quantity' => '8p',
            'points' => 1,
        ]);

        Product::create([
            'name' => 'Produs 2',
            'quantity' => '16p',
            'points' => 1,
        ]);

        Product::create([
            'name' => 'Produs 3',
            'quantity' => '24p',
            'points' => 2,
        ]);

        Product::create([
            'name' => 'Produs 4',
            'quantity' => '140g',
            'points' => 1,
        ]);
    }
}
