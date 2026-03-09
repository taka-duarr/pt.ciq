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
    public function create()
    {
        $produks = \App\Models\Produk::all();
        return view('pemesanan', compact('produks'));
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
            'telp' => 'required|string|max:20',
            'items' => 'required|array',
            'items.*.produk_id' => 'required|exists:produks,id',
            'items.*.qty' => 'required|numeric|min:0.1',
            'items.*.harga_total' => 'required|numeric',
        ]);

        foreach ($request->items as $item) {
            \App\Models\Pesanan::create([
                'nama_pemesan' => $request->nama_pemesan,
                'instansi' => $request->instansi,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'produk_id' => $item['produk_id'],
                'qty' => $item['qty'],
                'harga_total' => $item['harga_total'],
                'status' => 'Pending', // default status
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Pesanan berhasil disimpan.']);
    }
}
