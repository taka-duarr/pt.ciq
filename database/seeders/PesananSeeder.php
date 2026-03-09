<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Pesanan;

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pesanan::create([
            'nama_pemesan' => 'Andi Saputra',
            'instansi' => 'PT Sumber Jaya',
            'alamat' => 'Gresik, Jawa Timur',
            'telp' => '0812-3456-7890',
            'produk_id' => 1,
            'qty' => 12,
            'harga_total' => 1800000,
            'status' => 'Selesai'
        ]);

        Pesanan::create([
            'nama_pemesan' => 'Budi Raharjo',
            'instansi' => 'CV Mitra Konstruksi',
            'alamat' => 'Surabaya',
            'telp' => '0896-3344-2211',
            'produk_id' => 2,
            'qty' => 8,
            'harga_total' => 960000,
            'status' => 'Selesai'
        ]);
    }
}
