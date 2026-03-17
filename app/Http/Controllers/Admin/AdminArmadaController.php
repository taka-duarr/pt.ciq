<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Armada;
use Illuminate\Http\Request;

class AdminArmadaController extends Controller
{
    public function index()
    {
        $armadas = Armada::all();
        return view('admin.armada.index', compact('armadas'));
    }

    public function create()
    {
        return view('admin.armada.add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'minimal_ton' => 'required|integer|min:0',
            'maksimal_ton' => 'required|integer|min:0|gte:minimal_ton',
            'tarif_per_km' => 'required|numeric|min:0',
        ]);

        Armada::create($validated);

        return response('<script>window.parent.location.reload();</script>');
    }

    public function edit($id)
    {
        $armada = Armada::findOrFail($id);
        return view('admin.armada.edit', compact('armada'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'minimal_ton' => 'required|integer|min:0',
            'maksimal_ton' => 'required|integer|min:0|gte:minimal_ton',
            'tarif_per_km' => 'required|numeric|min:0',
        ]);

        $armada = Armada::findOrFail($id);
        $armada->update($validated);

        return response('<script>window.parent.location.reload();</script>');
    }

    public function destroy($id)
    {
        $armada = Armada::findOrFail($id);
        $armada->delete();

        return redirect()->back()->with('success', 'Armada berhasil dihapus');
    }
}
