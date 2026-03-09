<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminInvoiceController extends Controller
{
    public function show(Request $request)
    {
        // Ambil data dinamis dari session/query parameters jika perlu
        return view('admin.invoice', [
            'mode' => $request->query('mode'),
            'nama' => $request->query('nama'),
            'produk' => $request->query('produk'),
            'qty' => $request->query('qty'),
            'harga' => $request->query('harga'),
        ]);
    }
}
