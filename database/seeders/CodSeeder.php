<?php

namespace Database\Seeders;

use App\Models\Backend\Cod;
use App\Models\Backend\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produse = Product::all();

        foreach ($produse as $produs) {
            for ($i = 1; $i <= 10; $i++) {
                $cod = $this->generateUniqueCode($produs);

                Cod::create([
                    'cod' => $cod,
                    'product_id' => $produs->id,
                ]);
            }
        }
    }

    private function generateUniqueCode(Product $produs, $attempt = 0)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';

        for ($i = 0; $i < 16; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }

        if (Cod::where('cod', $code)->exists()) {
            if ($attempt < 5) {
                return $this->generateUniqueCode($produs, $attempt + 1);
            } else {
                throw new \Exception('Nu s-a putut genera un cod unic după 5 încercări.');
            }
        }

        return $code;
    }
}
