<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Laravel y Livewire',
            'cost' => 200000,
            'price' => 350000,
            'barcode' => '7561623132',
            'stock' => 1000,
            'alerts' => 10,
            'category_id' => 1,
            'image' => 'laravel.jpg'
        ]);
        Product::create([
            'name' => 'Running Nike',
            'cost' => 600000,
            'price' => 1500000,
            'barcode' => '8795613132',
            'stock' => 1000,
            'alerts' => 10,
            'category_id' => 2,
            'image' => 'nike.jpg'
        ]);
        Product::create([
            'name' => 'Iphone 13',
            'cost' => 900000,
            'price' => 1500000,
            'barcode' => '9695615632',
            'stock' => 1000,
            'alerts' => 10,
            'category_id' => 3,
            'image' => 'iphone.jpg'
        ]);
        Product::create([
            'name' => 'PC Gamer',
            'cost' => 1900000,
            'price' => 4500000,
            'barcode' => '896615632',
            'stock' => 1000,
            'alerts' => 10,
            'category_id' => 4,
            'image' => 'pcgamer.jpg'
        ]);
    }
}
