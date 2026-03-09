<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produk::create([
            'nama' => 'Batu Pecah 5-10 mm',
            'ukuran' => '5-10 mm',
            'harga' => 150000,
            'kategori' => 'Batu Pecah',
            'foto' => null,
            'stok' => 100
        ]);

        Produk::create([
            'nama' => 'Abu Batu',
            'ukuran' => '0-5 mm',
            'harga' => 120000,
            'kategori' => 'Abu Batu',
            'foto' => null,
            'stok' => 50
        ]);
    }
}
