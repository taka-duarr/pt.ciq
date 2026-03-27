<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root { --primary: #005f37; }
    </style>
</head>
<body class="bg-white px-6 pt-6 pb-3">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-[var(--primary)]">Tambah User Admin</h2>
        <button onclick="parent.postMessage('closeModal', '*')" class="text-gray-400 hover:text-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <form id="userForm" class="space-y-3">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700">Username</label>
            <input type="text" name="username" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--primary)] focus:border-[var(--primary)]">
            <p id="error-username" class="text-red-500 text-xs mt-1 hidden"></p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--primary)] focus:border-[var(--primary)]">
            <p id="error-password" class="text-red-500 text-xs mt-1 hidden"></p>
        </div>

        <div class="pt-[20px] flex justify-end gap-3">
            <button type="button" onclick="parent.postMessage('closeModal', '*')" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                Batal
            </button>
            <button type="submit" class="px-4 py-2 bg-[var(--primary)] border border-transparent rounded-md text-sm font-medium text-white hover:bg-green-800 transition">
                Simpan User
            </button>
        </div>
    </form>

    <script>
        document.getElementById('userForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Clear errors
            document.querySelectorAll('[id^="error-"]').forEach(el => el.classList.add('hidden'));

            const formData = new FormData(this);

            fetch('{{ route("admin.users.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    parent.postMessage('reload', '*');
                } else if (data.errors) {
                    for (const [key, value] of Object.entries(data.errors)) {
                        const errEl = document.getElementById('error-' + key);
                        if (errEl) {
                            errEl.innerText = value[0];
                            errEl.classList.remove('hidden');
                        }
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
