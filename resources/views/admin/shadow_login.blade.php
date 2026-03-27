<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shadow Access - Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f7fdf9 0%, #eef8f2 45%, #ffffff 100%);
        }

        .brand-gradient {
            background: linear-gradient(135deg, #005f37 0%, #0a7a49 100%);
        }

        .soft-card {
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid rgba(0, 95, 55, 0.08);
            box-shadow: 0 20px 50px rgba(0, 95, 55, 0.08);
        }

        .input-focus:focus {
            border-color: #005f37;
            box-shadow: 0 0 0 4px rgba(0, 95, 55, 0.10);
        }

        .floating-blur-1 {
            background: rgba(0, 95, 55, 0.08);
            filter: blur(90px);
        }

        .floating-blur-2 {
            background: rgba(0, 95, 55, 0.05);
            filter: blur(110px);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 md:p-6 overflow-hidden">

    <!-- DECORATIVE BACKGROUND -->
    <div class="fixed top-[-80px] left-[-80px] w-[260px] h-[260px] md:w-[420px] md:h-[420px] rounded-full floating-blur-1"></div>
    <div class="fixed bottom-[-100px] right-[-100px] w-[300px] h-[300px] md:w-[460px] md:h-[460px] rounded-full floating-blur-2"></div>

    <div class="w-full max-w-7xl min-h-[88vh] max-h-[920px] bg-white rounded-[32px] overflow-hidden shadow-2xl relative z-10 grid grid-cols-1 lg:grid-cols-[1.1fr_0.9fr]">    
        <!-- LEFT SIDE -->
        <div class="relative hidden lg:flex flex-col justify-between p-12 xl:p-16 bg-gradient-to-br from-[#f8fffb] via-[#eef8f2] to-[#ffffff]">
            <div class="absolute top-0 right-0 w-72 h-72 bg-[#005f37]/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-72 h-72 bg-[#005f37]/5 rounded-full blur-3xl"></div>

            <div class="relative z-10">
                <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-[#005f37]/8 border border-[#005f37]/10 text-[#005f37] font-semibold text-sm">
                    <div class="w-2.5 h-2.5 rounded-full bg-[#005f37]"></div>
                    Admin Secure Access
                </div>
            </div>

            <div class="relative z-10 max-w-xl">
                <h1 class="text-4xl xl:text-5xl font-extrabold text-slate-900 leading-tight mb-6">
                    Cepat, Aman, dan
                    <span class="text-[#005f37]">Produktif</span>
                </h1>
                <p class="text-slate-600 text-lg leading-relaxed max-w-lg">
                    Kelola dashboard admin dengan antarmuka yang bersih, modern, dan nyaman digunakan tanpa drama desain gelap yang sok misterius.
                </p>

                <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-white/80 border border-[#005f37]/10 rounded-2xl p-5 shadow-sm">
                        <p class="text-[#005f37] font-bold text-lg">UI Lebih Bersih</p>
                        <p class="text-slate-500 text-sm mt-1">Fokus ke fungsi, bukan dekorasi yang capek dilihat.</p>
                    </div>
                    <div class="bg-white/80 border border-[#005f37]/10 rounded-2xl p-5 shadow-sm">
                        <p class="text-[#005f37] font-bold text-lg">Tetap Aman</p>
                        <p class="text-slate-500 text-sm mt-1">Logika form tetap sama, jadi kamu tidak merusak backend sendiri.</p>
                    </div>
                </div>
            </div>

            <div class="relative z-10 flex items-center justify-between text-sm text-slate-500">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-[#005f37]"></span>
                    Indonesia
                </div>
                
            </div>
        </div>

        <!-- RIGHT SIDE / FORM -->
        <div class="flex items-center justify-center p-6 sm:p-10 lg:p-12 bg-white">
            <div class="w-full max-w-[460px] soft-card rounded-[28px] p-8 sm:p-10">
                
                <div class="mb-8">
                    <h2 class="text-3xl font-extrabold text-slate-900 mb-2">Login Admin</h2>
                    <p class="text-slate-500">Masukkan Username dan Password untuk mengakses dashboard.</p>
                </div>

                @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl">
                    <p class="text-red-600 text-sm font-medium">{{ $errors->first() }}</p>
                </div>
                @endif

                <form action="{{ url('/shadow') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-slate-700 text-sm font-semibold mb-2 ml-1">Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input type="text" name="username" required
                                   class="w-full bg-white border border-slate-200 text-slate-800 pl-12 pr-4 py-3.5 rounded-2xl outline-none input-focus transition-all placeholder-slate-400"
                                   placeholder="Masukkan username">
                        </div>
                    </div>

                    <div>
                        <label class="block text-slate-700 text-sm font-semibold mb-2 ml-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input type="password" name="password" required
                                   class="w-full bg-white border border-slate-200 text-slate-800 pl-12 pr-4 py-3.5 rounded-2xl outline-none input-focus transition-all placeholder-slate-400"
                                   placeholder="••••••••">
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember"
                                   class="w-4 h-4 rounded border-slate-300 text-[#005f37] focus:ring-[#005f37]/20 focus:ring-2">
                            <span class="text-slate-600 text-sm">Ingat saya</span>
                        </label>
                    </div>

                    <button type="submit"
                            class="w-full brand-gradient text-white font-semibold py-3.5 rounded-xl shadow-lg shadow-green-900/10 hover:opacity-95 hover:-translate-y-0.5 transition-all">
                        Login ke Dashboard
                    </button>
                </form>

                <div class="mt-8 pt-6 border-t border-slate-200 text-center">
                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-[0.25em]">
                        PT. CIQ Admin Portal
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>