<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = [
        'nama_pemesan',
        'instansi',
        'alamat',
        'wilayah',
        'telp',
        'produk_id',
        'qty',
        'harga_total',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
