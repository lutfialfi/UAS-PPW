<?php
// database/seeders/ProductSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'nama' => 'headphone-bass',
                'gambar' => 'headphone-bass.jpg',
            ],
            [
                'nama' => 'hoodie-oversize',
                'gambar' => 'hoodie-oversize.jpg',
            ],
            [
                'nama' => 'jam-classic',
                'gambar' => 'jam-classic.jpg',
            ],
            [
                'nama' => 'kaos-polos',
                'gambar' => 'kaos-polos.jpg',
            ],
            [
                'nama' => 'sneakers-x',
                'gambar' => 'sneakers-x.jpg',
            ],
        ]);
    }
}
