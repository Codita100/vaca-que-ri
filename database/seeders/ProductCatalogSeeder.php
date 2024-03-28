<?php

namespace Database\Seeders;

use App\Models\Backend\ProductCatalog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define datele pentru cele 17 produse
        $products = [
            ['name' => 'Produs 1', 'points' => 10, 'stock' => 50, 'photo' => 'photo1.jpg'],
            ['name' => 'Produs 2', 'points' => 8, 'stock' => 30, 'photo' => 'photo2.jpg'],
            ['name' => 'Produs 3', 'points' => 15, 'stock' => 20, 'photo' => 'photo3.jpg'],
            ['name' => 'Produs 4', 'points' => 5, 'stock' => 40, 'photo' => 'photo4.jpg'],
            ['name' => 'Produs 5', 'points' => 12, 'stock' => 25, 'photo' => 'photo5.jpg'],
        ];

        foreach ($products as $product) {
            ProductCatalog::create($product);
        }
    }
}
