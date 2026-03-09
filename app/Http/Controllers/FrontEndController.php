<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index()
    {
        $produks = \App\Models\Produk::all();
        return view('main', compact('produks'));
    }

    public function tentangKami()
    {
        return view('tentangKami');
    }

    public function katalogProduk()
    {
        $produks = \App\Models\Produk::all();
        return view('katalogProduk', compact('produks'));
    }

    public function detailProduk($id)
    {
        $produk = \App\Models\Produk::findOrFail($id);
        return view('detailProduk', compact('produk'));
    }

    public function csr()
    {
        return view('csr');
    }

    public function kontak()
    {
        return view('kontak');
    }

    public function pemesanan()
    {
        return view('pemesanan');
    }
}
