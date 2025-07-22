<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->truncate(); // hapus dulu isi produk lama

        DB::table('products')->insert([
            [
                'name' => 'Kaos Polos Hitam',
                'category' => 'Fashion',
                'price' => 75000,
                'stock' => 20,
                'description' => 'Kaos katun nyaman dan adem',
                'image' => 'image/kaos-polos.jpg',
            ],
            [
                'name' => 'Sepatu Sneakers X',
                'category' => 'Footwear',
                'price' => 350000,
                'stock' => 10,
                'description' => 'Sepatu ringan untuk aktivitas',
                'image' => 'image/sneakers-x.jpg',
            ],
            [
                'name' => 'Jam Tangan Classic',
                'category' => 'Accessories',
                'price' => 150000,
                'stock' => 15,
                'description' => 'Jam tangan analog kulit asli',
                'image' => 'image/jam-classic.jpg',
            ],
            [
                'name' => 'Hoodie Oversize',
                'category' => 'Fashion',
                'price' => 120000,
                'stock' => 8,
                'description' => 'Hoodie bahan fleece tebal',
                'image' => 'image/hoodie-oversize.jpg',
            ],
            [
                'name' => 'Headphone Bass HD',
                'category' => 'Electronics',
                'price' => 230000,
                'stock' => 12,
                'description' => 'Headphone suara jernih dan bass',
                'image' => 'image/headphone-bass.jpg',
            ],
        ]);
    }
}
