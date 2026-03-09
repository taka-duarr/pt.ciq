<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPesananController extends Controller
{
    public function index()
    {
        try {
            $pesanans = \App\Models\Pesanan::with('produk')->get();
        } catch (\Exception $e) {
            $pesanans = collect();
        }
        return view('admin.pesanan', compact('pesanans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pesanan = \App\Models\Pesanan::findOrFail($id);
        $pesanan->status = $request->input('status');
        $pesanan->save();

        return response()->json(['success' => true]);
    }
}
