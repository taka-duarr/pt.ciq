<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<script src="https://cdn.tailwindcss.com"></script>
<title>Tambah Produk</title>

<style>
    :root { --primary: #005f37; }
</style>
</head>

<body class="bg-white p-8 rounded-xl">

<!-- CLOSE BUTTON -->
<button onclick="parentCloseModal()"
        class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
         viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M6 18L18 6M6 6l12 12" />
    </svg>
</button>

<h2 class="text-2xl font-bold mb-6 text-[var(--primary)]">Tambah Produk Batu</h2>

<form id="formProduk" action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-2 gap-6">

        <div>
            <label class="block text-sm font-semibold mb-1">Nama Produk</label>
            <input type="text" name="nama" class="w-full border rounded px-3 py-2 focus:outline-none" required>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-1">Ukuran (mm)</label>
            <input type="text" name="ukuran" class="w-full border rounded px-3 py-2 focus:outline-none" required>
        </div>


        <div>
            <label class="block text-sm font-semibold mb-1">Kategori</label>
            <select name="kategori" class="w-full border rounded px-3 py-2 focus:outline-none">
                <option value="Abu Batu">Abu Batu</option>
                <option value="Batu Pecah 5–10 mm">Batu Pecah 5–10 mm</option>
                <option value="Batu Pecah 10–25 mm">Batu Pecah 10–25 mm</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-1">Upload Foto</label>
            <input type="file" name="foto" class="w-full border rounded px-3 py-2" accept="image/*" required>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-1">Stok Awal</label>
            <input type="number" name="stok" class="w-full border rounded px-3 py-2 focus:outline-none">
        </div>

        <div class="col-span-2">
            <label class="block text-sm font-semibold mb-1">Deskripsi Singkat (Muncul di Detail)</label>
            <textarea name="deskripsi_singkat" class="w-full border rounded px-3 py-2 h-20 focus:outline-none" placeholder="Ringkasan singkat material..."></textarea>
        </div>

        <div class="col-span-2">
            <label class="block text-sm font-semibold mb-1">Deskripsi Lengkap (Informasi Produk)</label>
            <textarea name="deskripsi_lengkap" class="w-full border rounded px-3 py-2 h-32 focus:outline-none" placeholder="Penjelasan detail hasil stone crusher..." required></textarea>
        </div>

        <div class="col-span-2">
            <label class="block text-sm font-semibold mb-1">Keunggulan Material (Pisahkan dengan baris baru)</label>
            <textarea name="keunggulan" class="w-full border rounded px-3 py-2 h-32 focus:outline-none" placeholder="✔ Gradasi seragam&#10;✔ Bebas lumpur..." required></textarea>
        </div>

    </div>

    <div class="flex justify-end mt-8">
        <button type="submit"
                class="bg-[var(--primary)] text-white px-5 py-2 rounded-lg hover:bg-[#004c2c] transition">
            Simpan
        </button>
    </div>

</form>

<script>
function parentCloseModal() {
    window.parent.document.getElementById("backdrop").classList.add("hidden");
    window.parent.document.getElementById("modalFrame").classList.add("hidden");
}
</script>

</body>
</html>