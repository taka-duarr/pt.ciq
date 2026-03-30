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
    <title>Manajemen User - Batu Split</title>
</head>

<body class="bg-gray-100">
    <!-- TOAST NOTIFICATIONS -->
    <div id="toast" class="hidden fixed top-5 right-5 bg-green-600 text-white px-4 py-2 rounded-lg shadow-lg z-[999]">
        Operasi berhasil!
    </div>

    <!-- SIDEBAR FIX -->
    <iframe id="sidebarFrame" src="{{ route('admin.sidebar') }}" class="fixed left-0 top-0 w-64 min-h-screen border-none"></iframe>

    <!-- MAIN CONTENT FIX -->
    <div id="mainContent" class="ml-64 flex-1 p-6 transition-all duration-300">
        <h2 class="text-2xl font-bold text-[var(--primary)] mb-6">
            Manajemen User Admin
        </h2>

        <!-- TOMBOL TAMBAH -->
        <button onclick="openAddModal()" class="bg-[var(--primary)] text-white px-4 py-2 rounded mb-4 hover:bg-green-800 transition">
            + Tambah User
        </button>

        <!-- BACKDROP -->
        <div id="modalBackdrop" class="hidden fixed inset-0 bg-black/40 z-40"></div>

        <!-- MODAL ADD -->
        <div id="addModal" class="hidden fixed inset-0 flex justify-center items-center z-50">
            <iframe id="addFrame" src="{{ route('admin.users.create') }}" class="bg-white rounded-xl shadow-xl w-[500px] h-[350px] border-none"></iframe>
        </div>

        <!-- MODAL EDIT -->
        <div id="editModal" class="hidden fixed inset-0 flex justify-center items-center z-50">
            <iframe id="editFrame" src="" class="bg-white rounded-xl shadow-xl w-[500px] h-[350px] border-none"></iframe>
        </div>

        <!-- MODAL DELETE -->
        <div id="deleteModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">
            <div class="bg-white rounded-2xl shadow-xl p-7 w-[380px] text-center">
                <div class="mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M4.93 19h14.14c1.1 0 1.99-.9 1.99-2l-7.07-12.25c-.78-1.35-2.73-1.35-3.51 0L2.94 17c0 1.1.9 2 1.99 2z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800 mb-2">Hapus User?</h2>
                <p class="text-gray-600 text-sm mb-6">User ini akan dihapus secara permanen.</p>
                <div class="flex justify-center gap-3">
                    <button onclick="closeDeleteModal()" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium w-32">Batal</button>
                    <button onclick="confirmDelete()" class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold w-32">Hapus</button>
                </div>
            </div>
        </div>

        <!-- TABLE -->
        <div class="bg-white shadow rounded-lg p-6">
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b">
                        <th class="py-3">Username</th>
                        <th class="py-3">Role</th>
                        <th class="py-3">Dibuat Pada</th>
                        <th class="py-3 text-center w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr class="border-b">
                        <td class="py-4 text-gray-800 font-medium">{{ $user->username }}</td>
                        <td class="py-4 text-gray-700 font-bold uppercase text-xs">
                            <span class="px-2 py-1 rounded bg-gray-200">{{ $user->role }}</span>
                        </td>
                        <td class="text-gray-500 text-sm">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="openEditModal('{{ route('admin.users.edit', $user->id) }}')" class="p-2 rounded-md bg-blue-100 hover:bg-blue-200 text-blue-700 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6-6m-6 6v3H6v-3m3 0h3" />
                                    </svg>
                                </button>
                                <button onclick="askDelete('{{ route('admin.users.destroy', $user->id) }}')" class="p-2 rounded-md bg-red-100 hover:bg-red-200 text-red-700 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 7h12m-9 0V5h6v2m-7 4v6m4-6v6m5 0H5"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-gray-500">Belum ada user admin.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        let deleteUrl = null;

        function showToast(message) {
            const t = document.getElementById("toast");
            t.innerText = message;
            t.classList.remove("hidden");
            setTimeout(() => t.classList.add("hidden"), 3000);
        }

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
            document.getElementById("editFrame").src = "";
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
        }

        // Handle messages from iframe
        window.addEventListener('message', function(event) {
            if (event.data === 'closeModal') {
                closeModal();
            } else if (event.data === 'reload') {
                location.reload();
            }
        });
    </script>
</body>
</html>
