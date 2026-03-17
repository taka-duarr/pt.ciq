<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Edit Armada</h2>

    <form action="{{ route('admin.armada.update', $armada->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-semibold mb-1">Nama Armada</label>
            <input type="text" name="nama" value="{{ old('nama', $armada->nama) }}" class="w-full border rounded px-3 py-2 outline-none focus:border-green-600" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1">Min. Tonase</label>
                <input type="number" name="minimal_ton" value="{{ old('minimal_ton', $armada->minimal_ton) }}" class="w-full border rounded px-3 py-2 outline-none focus:border-green-600" required>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Max. Tonase</label>
                <input type="number" name="maksimal_ton" value="{{ old('maksimal_ton', $armada->maksimal_ton) }}" class="w-full border rounded px-3 py-2 outline-none focus:border-green-600" required>
            </div>
        </div>

        <div class="pt-4 flex justify-end gap-3">
            <button type="button" onclick="window.parent.closeModal()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg">Batal</button>
            <button type="submit" class="px-4 py-2 bg-[#005f37] text-white rounded-lg">Simpan Perubahan</button>
        </div>
    </form>
</body>
</html>
