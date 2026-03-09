<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - {{ $produk->nama }} | CIQ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        :root { --primary: #005f37; }
        .text-primary { color: var(--primary); }
        .bg-primary { background-color: var(--primary); }
        /* Menghilangkan spinner pada input number */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
    </style>
</head>
<body class="bg-gray-50 antialiased">

    @include('navbar')

    <main class="max-w-7xl mx-auto px-6 py-12">
        <nav class="flex text-sm text-gray-500 mb-8 gap-2 uppercase tracking-widest font-bold text-[10px]">
            <a href="{{ route('home') }}" class="hover:text-primary transition">Beranda</a> 
            <span>/</span>
            <a href="{{ route('katalogProduk') }}" class="hover:text-primary transition">Katalog Material</a>
            <span>/</span>
            <span class="text-gray-800">{{ $produk->nama }} ({{ $produk->ukuran }})</span>
        </nav>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 bg-white p-6 md:p-12 rounded-[3rem] shadow-sm border border-gray-100">
            
            <div class="space-y-4">
                <div class="relative rounded-[1rem] overflow-hidden border border-gray-100 h-[300px] md:h-[500px] group">
                    <img id="mainImage" src="{{ $produk->foto ? asset('storage/' . $produk->foto) : '' }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="{{ $produk->nama }}">
                </div>
                @if($produk->foto)
                <div class="grid grid-cols-4 gap-4">
                    <button onclick="changeImg(`{{ asset('storage/' . $produk->foto) }}`)" class="rounded-lg overflow-hidden border-2 border-primary h-20 md:h-24">
                        <img src="{{ asset('storage/' . $produk->foto) }}" class="w-full h-full object-cover">
                    </button>
                </div>
                @endif
            </div>

            <div class="flex flex-col justify-center space-y-8">
                <div>
                    <span class="bg-primary/10 text-primary text-[10px] font-black px-4 py-1 rounded-full uppercase tracking-tighter mb-4 inline-block">Material Konstruksi</span>
                    <h1 class="text-4xl md:text-5xl font-black text-gray-800 leading-tight">{{ $produk->nama }} ({{ $produk->ukuran }})</h1>
                    
                </div>

                <div class="space-y-2">
                    <p class="text-4xl font-black text-primary italic">Rp {{ number_format($produk->harga, 0, ',', '.') }} <span class="text-sm font-normal text-gray-400 uppercase tracking-widest not-italic">/ Ton</span></p>
                    <p class="text-xs text-green-600 font-bold flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs">check_circle</span> Stok Tersedia (Ready Stock)
                    </p>
                </div>

                <p class="text-gray-500 leading-relaxed text-sm md:text-base border-l-4 border-gray-100 pl-6 italic">
                    Material jenis ini banyak dibutuhkan untuk campuran dalam proses pengaspalan dan bisa digunakan sebagai pengganti pasir, material ini adalah bahan utama dari pembuatan gorong-gorong dan batako press.
                </p>

                <div class="flex flex-wrap items-center gap-6 pt-4">
                    
                    
                    <a href="{{ route('pemesanan') }}" class="flex-1 md:flex-none bg-primary text-white px-12 py-4 rounded-2xl font-black uppercase tracking-widest shadow-xl shadow-green-900/20 hover:bg-[#004c2c] hover:scale-105 transition-all flex items-center justify-center gap-3">
                        Pesan Sekarang
                    </a>
                </div>

                <div class="pt-8 border-t border-gray-100 grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-widest mb-1">Kategori</p>
                        <p class="text-xs text-gray-800 font-bold uppercase">{{ $produk->kategori }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-widest mb-1">Pengiriman</p>
                        <p class="text-xs text-gray-800 font-bold uppercase">Seluruh Jawa Timur</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-16">
            <div class="flex border-b border-gray-200 gap-12">
                <button class="border-b-4 border-primary pb-4 font-black uppercase tracking-widest text-xs text-primary">Informasi Produk</button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 py-10">
                <div class="md:col-span-2 space-y-6 text-gray-500 leading-relaxed">
                    <p>{{ $produk->nama }} berukuran {{ $produk->ukuran }} merupakan hasil sampingan dari proses pemecahan batu split (stone crusher). Material ini memiliki tekstur butiran halus yang tajam, sangat ideal sebagai pengikat dalam konstruksi.</p>
                    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                        <h4 class="text-gray-800 font-black uppercase tracking-widest text-xs mb-4 flex items-center gap-2">
                            <span class="w-2 h-2 bg-primary rounded-full"></span> Keunggulan Material
                        </h4>
                        <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                            <li class="flex items-start gap-2">
                                <span class="text-primary font-bold">✔</span> Gradasi butiran seragam (0-5 mm)
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-primary font-bold">✔</span> Meningkatkan kepadatan aspal/beton
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-primary font-bold">✔</span> Bebas dari kandungan lumpur berlebih
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-primary font-bold">✔</span> Ekonomis untuk proyek skala besar
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="bg-primary p-8 rounded-[2.5rem] text-white shadow-2xl h-fit">
                    <h4 class="font-black uppercase tracking-widest text-xs mb-6">Butuh Konsultasi?</h4>
                    <p class="text-sm opacity-80 mb-6 leading-relaxed">Hubungi admin kami untuk estimasi biaya pengiriman dan ketersediaan ritase armada hari ini.</p>
                    <a href="https://wa.me/6281252142002" class="block w-full text-center bg-white text-primary py-4 rounded-2xl font-black uppercase tracking-widest text-xs hover:scale-105 transition">Chat WhatsApp</a>
                </div>
            </div>
        </div>
    </main>
    @include('footer')
    <script>
        // Fungsi ganti gambar utama
        function changeImg(path) {
            const main = document.getElementById('mainImage');
            main.classList.add('opacity-0');
            setTimeout(() => {
                main.src = path;
                main.classList.remove('opacity-0');
            }, 200);
        }

      
    </script>
</body>
</html>