<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $produks = \App\Models\Produk::all();
        $armadas = \App\Models\Armada::all();
        
        $selectedProdukId = $request->query('produk_id');
        $selectedProduk = $selectedProdukId ? \App\Models\Produk::find($selectedProdukId) : null;

        return view('pemesanan', compact('produks', 'armadas', 'selectedProduk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'instansi' => 'nullable|string|max:255',
            'alamat' => 'required|string',
            'wilayah' => 'nullable|string',
            'telp' => 'required|string|max:20',
            'produk_id' => 'required|exists:produks,id',
            'qty' => 'required|numeric|min:0.1',
            'harga_total' => 'required|numeric',
        ]);

        \App\Models\Pesanan::create([
            'nama_pemesan' => $request->nama_pemesan,
            'instansi' => $request->instansi,
            'alamat' => $request->alamat,
            'wilayah' => $request->wilayah,
            'telp' => $request->telp,
            'produk_id' => $request->produk_id,
            'qty' => $request->qty,
            'harga_total' => $request->harga_total,
        ]);

        return response()->json(['success' => true, 'message' => 'Pesanan berhasil disimpan.']);
    }
}
