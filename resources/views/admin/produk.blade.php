<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <style>
        :root {
            --primary: #005f37;
        }
    </style>
    <title>Produk Batu</title>
</head>
<!-- Hapus Data-->
<div id="toastDelete" class="hidden fixed top-5 right-5 bg-red-600 text-white px-4 py-2 rounded-lg shadow-md z-[999]">
    Produk berhasil dihapus!
</div>

<script>
    function showDeleteToast() {
        const t = document.getElementById("toastDelete");
        t.classList.remove("hidden");
        setTimeout(() => t.classList.add("hidden"), 2000);
    }
</script>
<!-- BACKDROP EDIT -->
<div id="editBackdrop" class="hidden fixed inset-0 bg-black/40 z-40"></div>

<!-- MODAL IFRAME EDIT -->
<div id="editFrame" class="hidden fixed inset-0 flex justify-center items-center z-50">
    <iframe id="iframeEditProduk" src="" class="bg-white rounded-xl shadow-xl w-[700px] h-[500px] border-none">
    </iframe>
</div>

<script>
    function openEditModal(url) {
        document.getElementById("iframeEditProduk").src = url;
        document.getElementById("editBackdrop").classList.remove("hidden");
        document.getElementById("editFrame").classList.remove("hidden");
    }
</script>
<div id="toast-edit" class="hidden fixed top-5 right-5 bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg z-[999]">
    Produk berhasil diperbarui!
</div>

<script>
    function showEditToast() {
        const toast = document.getElementById("toast-edit");
        toast.classList.remove("hidden");
        setTimeout(() => toast.classList.add("hidden"), 2000);
    }
</script>
<!-- add data -->
<div id="toast" class="hidden fixed top-5 right-5 bg-green-600 text-white px-4 py-2 rounded-lg shadow-lg z-[999]">
    Produk berhasil ditambahkan!
</div>

<script>
    function showToast() {
        const toast = document.getElementById("toast");
        toast.classList.remove("hidden");

        setTimeout(() => {
            toast.classList.add("hidden");
        }, 2000);
    }
</script>

<body class="bg-gray-100">
    <!-- SIDEBAR FIX -->
    @include('admin.sidebar')

    <!-- MAIN CONTENT FIX -->
    <div id="mainContent" class="ml-64 flex-1 p-6 transition-all duration-300">
        <h2 class="text-2xl font-bold text-[var(--primary)] mb-6">
            Manajemen Produk Batu
        </h2>
        <!-- TOMBOL -->
        <button onclick="openModal()" class="bg-[var(--primary)] text-white px-4 py-2 rounded mb-4">
            + Tambah Produk
        </button>

        <!-- BACKDROP -->
        <div id="backdrop" class="hidden fixed inset-0 bg-black/40 z-40"></div>

        <!-- MODAL IFRAME -->
        <div id="modalFrame" class="hidden fixed inset-0 flex justify-center items-center z-50">
            <iframe src="{{ route('admin.produk.create') }}"
                class="bg-white rounded-xl shadow-xl w-[700px] h-[500px] border-none">
            </iframe>
        </div>

        <script>
            function openModal() {
                document.getElementById("backdrop").classList.remove("hidden");
                document.getElementById("modalFrame").classList.remove("hidden");
            }
        </script>

        <div class="bg-white shadow rounded-lg p-6">
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b">
                        <th class="py-3 w-40">Foto</th>
                        <th class="py-3">Nama</th>
                        <th class="py-3">Ukuran</th>
                        <th class="py-3">Deskripsi</th>
                        <th class="py-3 text-center w-32">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($produks as $produk)
                        <tr class="border-b">
                            <!-- FOTO PRODUK, RASIO 3:4 -->
                            <td class="py-4">
                                <div class="w-32 aspect-[3/4] overflow-hidden rounded-lg">
                                    <img src="{{ $produk->foto ? asset('storage/' . $produk->foto) : asset('img/batu.jpg') }}"
                                        class="w-full h-full object-cover" />
                                </div>
                            </td>

                            <td class="text-gray-800 font-medium">{{ $produk->nama }}</td>
                            <td>{{ $produk->ukuran }}</td>
                            <td>
                                <button onclick='showDetailProduk(@json($produk))'
                                    class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-md text-sm border transition">
                                    Detail
                                </button>
                            </td>
                            <td class="text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="openEditModal(`{{ route('admin.produk.edit', $produk->id) }}`)"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-blue-50 text-blue-600 border border-blue-100 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all duration-200 shadow-sm group">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-4 h-4 transition-transform group-hover:scale-110" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        <span class="text-xs font-semibold tracking-wide uppercase">Edit</span>
                                    </button>

                                    <button onclick="askDelete(`{{ route('admin.produk.destroy', $produk->id) }}`)"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 text-red-600 border border-red-100 hover:bg-red-600 hover:text-white hover:border-red-600 transition-all duration-200 shadow-sm group">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-4 h-4 transition-transform group-hover:rotate-12" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span class="text-xs font-semibold tracking-wide uppercase">Hapus</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-gray-500">Belum ada data produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL DETAIL PRODUK -->
    <div id="detailProdukModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-[60]">
        <div class="bg-white rounded-2xl shadow-xl w-[600px] max-h-[80vh] overflow-hidden flex flex-col">
            <div class="p-5 border-b flex justify-between items-center bg-gray-50">
                <h3 id="detailTitle" class="text-xl font-bold text-gray-800">Detail Produk</h3>
                <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
            </div>
            <div class="p-6 overflow-y-auto space-y-6">
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Deskripsi
                        Singkat</label>
                    <p id="detailSingkat" class="text-gray-700 mt-1 leading-relaxed"></p>
                </div>
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Deskripsi
                        Lengkap</label>
                    <p id="detailLengkap" class="text-gray-700 mt-1 leading-relaxed whitespace-pre-line"></p>
                </div>
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Keunggulan
                        Material</label>
                    <ul id="detailKeunggulan" class="mt-2 space-y-2"></ul>
                </div>
            </div>
            <div class="p-4 border-t bg-gray-50 text-right">
                <button onclick="closeDetailModal()"
                    class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition">Tutup</button>
            </div>
        </div>
    </div>
</body>
<!-- MODAL DELETE -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div class="bg-white rounded-2xl shadow-xl p-7 w-[380px] text-center">

        <!-- ICON WARNING -->
        <div class="mx-auto mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-red-500 mx-auto" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01M4.93 19h14.14c1.1 0 1.99-.9 1.99-2l-7.07-12.25c-.78-1.35-2.73-1.35-3.51 0L2.94 17c0 1.1.9 2 1.99 2z" />
            </svg>
        </div>

        <!-- TITLE -->
        <h2 class="text-xl font-bold text-gray-800 mb-2">Hapus Produk?</h2>

        <!-- SUBTEXT -->
        <p class="text-gray-600 text-sm mb-6">
            Produk ini akan dihapus secara permanen.
            Tindakan ini tidak bisa dibatalkan.
        </p>

        <!-- BUTTON GROUP -->
        <div class="flex justify-center gap-3">

            <button onclick="closeDeleteModal()"
                class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium w-32">
                Batal
            </button>

            <button onclick="confirmDelete()"
                class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold w-32">
                Hapus
            </button>

        </div>

    </div>

</div>

<script>
    let deleteUrl = null;

    // buka modal dengan ID produk
    function askDelete(url) {
        deleteUrl = url;
        document.getElementById("deleteModal").classList.remove("hidden");
    }

    // tutup modal
    function closeDeleteModal() {
        document.getElementById("deleteModal").classList.add("hidden");
    }

    // aksi hapus final
    function confirmDelete() {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = deleteUrl;

        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);

        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        form.appendChild(methodField);

        document.body.appendChild(form);
        form.submit();

        // tampilkan notifikasi (tapi karena ke-reload, opsional via session flash)
        showDeleteToast();
    }

    function showDetailProduk(produk) {
        document.getElementById('detailTitle').innerText = produk.nama;
        document.getElementById('detailSingkat').innerText = produk.deskripsi_singkat || '-';
        document.getElementById('detailLengkap').innerText = produk.deskripsi_lengkap || '-';

        const list = document.getElementById('detailKeunggulan');
        list.innerHTML = '';
        if (produk.keunggulan) {
            produk.keunggulan.split('\n').forEach(item => {
                if (item.trim()) {
                    const li = document.createElement('li');
                    li.className = 'flex items-start gap-2 text-sm text-gray-600';
                    li.innerHTML = `<span class="text-green-500">✔</span> <span>${item}</span>`;
                    list.appendChild(li);
                }
            });
        } else {
            list.innerHTML = '<li class="text-sm text-gray-400 italic">Tidak ada data keunggulan</li>';
        }

        document.getElementById('detailProdukModal').classList.remove('hidden');
    }

    function closeDetailModal() {
        document.getElementById('detailProdukModal').classList.add('hidden');
    }
</script>

</html>
