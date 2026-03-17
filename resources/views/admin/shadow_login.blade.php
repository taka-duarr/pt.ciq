<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shadow Access - Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #0f172a; /* Slate 900 */
        }
        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .primary-gradient {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        }
        .input-focus:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">

    <!-- DECORATIVE ELEMENTS -->
    <div class="fixed top-[-10%] left-[-10%] w-[40%] h-[40%] bg-emerald-900/20 rounded-full blur-[120px]"></div>
    <div class="fixed bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-blue-900/20 rounded-full blur-[120px]"></div>

    <div class="w-full max-w-[420px] glass p-8 rounded-2xl shadow-2xl relative z-10">
        
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl primary-gradient mb-6 shadow-lg shadow-emerald-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-white mb-1">Shadow Access</h1>
            <p class="text-slate-400 text-sm">Masukkan kredensial untuk melanjutkan</p>
        </div>

        @if($errors->any())
        <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-xl">
            <p class="text-red-400 text-sm font-medium">{{ $errors->first() }}</p>
        </div>
        @endif

        <form action="{{ url('/shadow') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-slate-300 text-sm font-medium mb-1.5 ml-1">Username</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <input type="text" name="username" required 
                           class="w-full bg-slate-800/50 border border-slate-700 text-white pl-11 pr-4 py-3 rounded-xl outline-none input-focus transition-all placeholder-slate-600"
                           placeholder="admin_user">
                </div>
            </div>

            <div>
                <label class="block text-slate-300 text-sm font-medium mb-1.5 ml-1">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input type="password" name="password" required 
                           class="w-full bg-slate-800/50 border border-slate-700 text-white pl-11 pr-4 py-3 rounded-xl outline-none input-focus transition-all placeholder-slate-600"
                           placeholder="••••••••">
                </div>
            </div>

            <div class="flex items-center justify-between pt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-700 bg-slate-800 text-emerald-500 focus:ring-emerald-500/20 focus:ring-offset-0">
                    <span class="text-slate-400 text-sm">Ingat saya</span>
                </label>
            </div>

            <button type="submit" 
                    class="w-full primary-gradient text-white font-semibold py-3.5 rounded-xl shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/40 transform hover:-translate-y-0.5 transition-all">
                Login ke Dashboard
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-slate-700/50 text-center">
            <p class="text-slate-500 text-xs font-medium uppercase tracking-widest">PT. CIQ Admin Portal</p>
        </div>
    </div>

</body>
</html>
