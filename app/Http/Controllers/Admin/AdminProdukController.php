<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminProdukController extends Controller
{
    public function index()
    {
        try {
            $produks = \App\Models\Produk::all();
        } catch (\Exception $e) {
            $produks = collect(); // Fallback empty collection if DB not ready
        }
        return view('admin.produk', compact('produks'));
    }

    public function create()
    {
        return view('admin.add_produk');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'ukuran' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'kategori' => 'required|string|max:255',
            'stok' => 'nullable|integer',
            'foto' => 'nullable|image|file|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('produk-images', 'public');
        }

        \App\Models\Produk::create($validatedData);

        return response('<script>window.parent.location.reload();</script>');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $produk = \App\Models\Produk::findOrFail($id);
        return view('admin.edit_produk', compact('produk'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'ukuran' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'kategori' => 'required|string|max:255',
            'stok' => 'nullable|integer',
            'foto' => 'nullable|image|file|max:2048'
        ]);

        $produk = \App\Models\Produk::findOrFail($id);
        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            if ($produk->foto && \Illuminate\Support\Facades\Storage::disk('public')->exists($produk->foto)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($produk->foto);
            }
            $data['foto'] = $request->file('foto')->store('produk-images', 'public');
        }

        $produk->update($data);

        return response('<script>window.parent.location.reload();</script>');
    }

    public function destroy(string $id)
    {
        $produk = \App\Models\Produk::findOrFail($id);
        if ($produk->foto && \Illuminate\Support\Facades\Storage::disk('public')->exists($produk->foto)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($produk->foto);
        }
        $produk->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus');
    }
}
