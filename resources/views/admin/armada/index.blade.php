<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <style>
        :root { --primary: #005f37; }
    </style>
    <title>Manajemen Armada</title>
</head>
<body class="bg-gray-100">
    <!-- Toasts -->
    <div id="toast" class="hidden fixed top-5 right-5 bg-green-600 text-white px-4 py-2 rounded-lg shadow-lg z-[999]"></div>
    <div id="toastDelete" class="hidden fixed top-5 right-5 bg-red-600 text-white px-4 py-2 rounded-lg shadow-md z-[999]">Armada berhasil dihapus!</div>

    <!-- Modals Background -->
    <div id="modalBackdrop" class="hidden fixed inset-0 bg-black/40 z-40" onclick="closeModal()"></div>

    <!-- Add Modal -->
    <div id="addModal" class="hidden fixed inset-0 flex justify-center items-center z-50">
        <iframe src="{{ route('admin.armada.create') }}" class="bg-white rounded-xl shadow-xl w-[500px] h-[400px] border-none"></iframe>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="hidden fixed inset-0 flex justify-center items-center z-50">
        <iframe id="editFrame" src="" class="bg-white rounded-xl shadow-xl w-[500px] h-[400px] border-none"></iframe>
    </div>

    <!-- Sidebar Frame -->
    <iframe id="sidebarFrame" src="{{ route('admin.sidebar') }}" class="fixed left-0 top-0 w-64 min-h-screen border-none"></iframe>

    <!-- Main Content -->
    <div id="mainContent" class="ml-64 flex-1 p-6 transition-all duration-300">
        <h2 class="text-2xl font-bold text-[var(--primary)] mb-6">Manajemen Armada</h2>

        <button onclick="openAddModal()" class="bg-[var(--primary)] text-white px-4 py-2 rounded mb-4 shadow hover:opacity-90 transition">
            + Tambah Armada
        </button>

        <div class="bg-white shadow rounded-lg p-6">
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b">
                        <th class="py-3">Nama Armada</th>
                        <th class="py-3">Min. Tonase</th>
                        <th class="py-3">Max. Tonase</th>
                        <th class="py-3">Tarif / KM</th>
                        <th class="py-3 text-center w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($armadas as $armada)
                    <tr class="border-b">
                        <td class="py-4 text-gray-800 font-medium">{{ $armada->nama }}</td>
                        <td>{{ $armada->minimal_ton }} Ton</td>
                        <td>{{ $armada->maksimal_ton }} Ton</td>
                        <td class="text-green-600 font-bold">Rp {{ number_format($armada->tarif_per_km, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="openEditModal('{{ route('admin.armada.edit', $armada->id) }}')" class="p-2 rounded-md bg-blue-100 hover:bg-blue-200 text-blue-700 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6-6m-6 6v3H6v-3m3 0h3" />
                                    </svg>
                                </button>
                                <button onclick="askDelete('{{ route('admin.armada.destroy', $armada->id) }}')" class="p-2 rounded-md bg-red-100 hover:bg-red-200 text-red-700 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 7h12m-9 0V5h6v2m-7 4v6m4-6v6m5 0H5"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-gray-500">Belum ada data armada.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Delete -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-xl p-7 w-[380px] text-center">
            <h2 class="text-xl font-bold text-gray-800 mb-2">Hapus Armada?</h2>
            <p class="text-gray-600 text-sm mb-6">Tindakan ini tidak bisa dibatalkan.</p>
            <div class="flex justify-center gap-3">
                <button onclick="closeDeleteModal()" class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 w-32">Batal</button>
                <button onclick="confirmDelete()" class="px-4 py-2 rounded-lg bg-red-600 text-white font-semibold w-32">Hapus</button>
            </div>
        </div>
    </div>

    <script>
        let deleteUrl = null;

        function openAddModal() {
            document.getElementById("modalBackdrop").classList.remove("hidden");
            document.getElementById("addModal").classList.remove("hidden");
        }

        function openEditModal(url) {
            document.getElementById("editFrame").src = url;
            document.getElementById("modalBackdrop").classList.remove("hidden");
            document.getElementById("editModal").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById("modalBackdrop").classList.add("hidden");
            document.getElementById("addModal").classList.add("hidden");
            document.getElementById("editModal").classList.add("hidden");
        }

        function askDelete(url) {
            deleteUrl = url;
            document.getElementById("deleteModal").classList.remove("hidden");
        }

        function closeDeleteModal() { document.getElementById("deleteModal").classList.add("hidden"); }

        function confirmDelete() {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = deleteUrl;
            form.innerHTML = `<input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="_method" value="DELETE">`;
            document.body.appendChild(form);
            form.submit();
        }
    </script>
</body>
</html>
