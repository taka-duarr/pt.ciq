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
    <title>Manajemen Armada</title>
</head>

<body class="bg-gray-100">
    <!-- Toasts -->
    <div id="toast" class="hidden fixed top-5 right-5 bg-green-600 text-white px-4 py-2 rounded-lg shadow-lg z-[999]">
    </div>
    <div id="toastDelete" class="hidden fixed top-5 right-5 bg-red-600 text-white px-4 py-2 rounded-lg shadow-md z-[999]">
        Armada berhasil dihapus!</div>

    <!-- Modals Background -->
    <div id="modalBackdrop" class="hidden fixed inset-0 bg-black/40 z-40" onclick="closeModal()"></div>

    <!-- Add Modal -->
    <div id="addModal" class="hidden fixed inset-0 flex justify-center items-center z-50">
        <iframe src="{{ route('admin.armada.create') }}"
            class="bg-white rounded-xl shadow-xl w-[500px] h-[400px] border-none"></iframe>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="hidden fixed inset-0 flex justify-center items-center z-50">
        <iframe id="editFrame" src=""
            class="bg-white rounded-xl shadow-xl w-[500px] h-[400px] border-none"></iframe>
    </div>

    <!-- Sidebar Frame -->
    <iframe id="sidebarFrame" src="{{ route('admin.sidebar') }}"
        class="fixed left-0 top-0 w-64 min-h-screen border-none"></iframe>

    <!-- Main Content -->
    <div id="mainContent" class="ml-64 flex-1 p-6 transition-all duration-300">
        <h2 class="text-2xl font-bold text-[var(--primary)] mb-6">Manajemen Armada</h2>

        <button onclick="openAddModal()"
            class="bg-[var(--primary)] text-white px-4 py-2 rounded mb-4 shadow hover:opacity-90 transition">
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
                            <td class="text-green-600 font-bold">Rp
                                {{ number_format($armada->tarif_per_km, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <div class="flex items-center justify-center gap-2">
    <button onclick="openEditModal('{{ route('admin.armada.edit', $armada->id) }}')"
        class="group inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-600 border border-indigo-100 hover:bg-indigo-600 hover:text-white transition-all duration-200 shadow-sm"
        title="Edit Armada">
        <svg xmlns="http://www.w3.org/2000/svg" 
            class="w-4 h-4 transition-transform group-hover:scale-110" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>
        <span class="text-[10px] font-bold tracking-widest uppercase">Edit</span>
    </button>

    <button onclick="askDelete('{{ route('admin.armada.destroy', $armada->id) }}')"
        class="group inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-rose-50 text-rose-600 border border-rose-100 hover:bg-rose-600 hover:text-white transition-all duration-200 shadow-sm"
        title="Hapus Armada">
        <svg xmlns="http://www.w3.org/2000/svg" 
            class="w-4 h-4 transition-transform group-hover:rotate-12" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
        <span class="text-[10px] font-bold tracking-widest uppercase">Hapus</span>
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
                <button onclick="closeDeleteModal()"
                    class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 w-32">Batal</button>
                <button onclick="confirmDelete()"
                    class="px-4 py-2 rounded-lg bg-red-600 text-white font-semibold w-32">Hapus</button>
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

        function closeDeleteModal() {
            document.getElementById("deleteModal").classList.add("hidden");
        }

        function confirmDelete() {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = deleteUrl;
            form.innerHTML =
                `<input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="_method" value="DELETE">`;
            document.body.appendChild(form);
            form.submit();
        }
    </script>
</body>

</html>
