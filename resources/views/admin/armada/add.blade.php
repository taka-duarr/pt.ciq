<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Tambah Armada Baru</h2>

    <form action="{{ route('admin.armada.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-semibold mb-1">Nama Armada</label>
            <input type="text" name="nama" class="w-full border rounded px-3 py-2 outline-none focus:border-green-600" placeholder="Contoh: Truk Kecil" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1">Min. Tonase</label>
                <input type="number" name="minimal_ton" class="w-full border rounded px-3 py-2 outline-none focus:border-green-600" placeholder="10" required>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Max. Tonase</label>
                <input type="number" name="maksimal_ton" class="w-full border rounded px-3 py-2 outline-none focus:border-green-600" placeholder="15" required>
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-1">Tarif per KM (Rp)</label>
            <input type="number" name="tarif_per_km" class="w-full border rounded px-3 py-2 outline-none focus:border-green-600" placeholder="Contoh: 35000" required>
        </div>

        <div class="pt-4 flex justify-end gap-3">
            <button type="button" onclick="window.parent.closeModal()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg">Batal</button>
            <button type="submit" class="px-4 py-2 bg-[#005f37] text-white rounded-lg">Simpan Armada</button>
        </div>
    </form>
</body>
</html>
