<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<script src="https://cdn.tailwindcss.com"></script>
<title>Edit Produk</title>

<style>
    :root { --primary: #005f37; }
</style>
</head>

<body class="bg-white p-8 rounded-xl">

<!-- CLOSE BUTTON -->
<button onclick="parentCloseEditModal()"
        class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
         viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M6 18L18 6M6 6l12 12" />
    </svg>
</button>

<h2 class="text-2xl font-bold mb-6 text-[var(--primary)]">Edit Produk Batu</h2>

<form id="formEditProduk" action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-2 gap-6">

        <div>
            <label class="block text-sm font-semibold mb-1">Nama Produk</label>
            <input type="text" id="namaProduk" name="nama"
                   class="w-full border rounded px-3 py-2 focus:outline-none"
                   value="{{ old('nama', $produk->nama) }}" required>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-1">Ukuran (mm)</label>
            <input type="text" id="ukuran" name="ukuran"
                   class="w-full border rounded px-3 py-2 focus:outline-none"
                   value="{{ old('ukuran', $produk->ukuran) }}" required>
        </div>


        <div class="col-span-2">
            <label class="block text-sm font-semibold mb-1">Ganti Foto</label>
            <input type="file" id="foto" name="foto"
                   class="w-full border rounded px-3 py-2" accept="image/*">
            @if($produk->foto)
            <img src="{{ asset('storage/' . $produk->foto) }}" class="mt-2 w-20 h-auto rounded">
            @endif
        </div>

        <div class="col-span-2">
            <label class="block text-sm font-semibold mb-1">Deskripsi Singkat (Muncul di Detail)</label>
            <textarea name="deskripsi_singkat" class="w-full border rounded px-3 py-2 h-20 focus:outline-none">{{ old('deskripsi_singkat', $produk->deskripsi_singkat) }}</textarea>
        </div>

        <div class="col-span-2">
            <label class="block text-sm font-semibold mb-1">Deskripsi Lengkap (Informasi Produk)</label>
            <textarea name="deskripsi_lengkap" class="w-full border rounded px-3 py-2 h-32 focus:outline-none" required>{{ old('deskripsi_lengkap', $produk->deskripsi_lengkap) }}</textarea>
        </div>

        <div class="col-span-2">
            <label class="block text-sm font-semibold mb-1">Keunggulan Material (Pisahkan dengan baris baru)</label>
            <textarea name="keunggulan" class="w-full border rounded px-3 py-2 h-32 focus:outline-none" required>{{ old('keunggulan', $produk->keunggulan) }}</textarea>
        </div>

    </div>

    <div class="flex justify-end mt-8">
        <button type="submit"
                class="bg-[var(--primary)] text-white px-5 py-2 rounded-lg hover:bg-[#004c2c] transition">
            Simpan Perubahan
        </button>
    </div>

</form>

<script>
function parentCloseEditModal() {
    window.parent.document.getElementById("editBackdrop").classList.add("hidden");
    window.parent.document.getElementById("editFrame").classList.add("hidden");
}
</script>

</body>
</html>