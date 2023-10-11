<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        for ($i=1; $i < 11; $i++) { 
            Product::create([
                'name' => 'Product ' . $i,
                'price' => $i * 200
            ]);
        }
       
    }
}
