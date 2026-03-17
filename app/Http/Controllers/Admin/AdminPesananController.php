<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPesananController extends Controller
{
    public function index()
    {
        try {
            $pesanans = \App\Models\Pesanan::with('produk')->latest()->get();
        } catch (\Exception $e) {
            $pesanans = collect();
        }
        return view('admin.pesanan', compact('pesanans'));
    }
}
