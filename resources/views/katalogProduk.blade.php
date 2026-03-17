<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk | PT Conbloc Indotama Quarry</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <style>
        :root {
            --primary: #005f37;
        }

        .text-primary {
            color: var(--primary);
        }

        .bg-primary {
            background-color: var(--primary);
        }
    </style>
</head>

<body class="bg-gray-50 antialiased">

    @include('navbar')

    <header class="py-16 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="flex items-center justify-center gap-3 mb-4">
                <span class="w-12 h-[2px] bg-primary"></span>
                <p class="text-primary font-bold tracking-widest text-xs uppercase">Katalog Material</p>
                <span class="w-12 h-[2px] bg-primary"></span>
            </div>
            <h1 class="text-4xl md:text-5xl font-black text-gray-800 leading-tight">
                Pilihan Batu Split <br> <span class="text-primary">Kualitas Premium</span>
            </h1>
            <p class="text-gray-500 mt-6 max-w-2xl mx-auto italic">
                Material terbaik yang diproses dengan standar tinggi untuk memastikan ketahanan struktur bangunan Anda.
            </p>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-20">
        <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
            <div class="flex gap-4">
                <button class="bg-primary text-white px-6 py-2 rounded-full text-xs font-bold uppercase tracking-widest shadow-lg">Semua</button>
                <button class="bg-white text-gray-400 px-6 py-2 rounded-full text-xs font-bold uppercase tracking-widest border border-gray-100 hover:text-primary transition">Batu Split</button>
                <button class="bg-white text-gray-400 px-6 py-2 rounded-full text-xs font-bold uppercase tracking-widest border border-gray-100 hover:text-primary transition">Abu Batu</button>
            </div>
            <div class="relative w-full md:w-80">
                <input type="text" placeholder="Cari jenis batu..." class="w-full pl-12 pr-4 py-3 rounded-2xl bg-white border border-gray-100 focus:border-primary outline-none text-sm transition shadow-sm">
                <span class="material-symbols-outlined absolute left-4 top-3 text-gray-300">search</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @foreach($produks as $produk)
            <div class="group bg-white p-4 rounded-[1rem] shadow-sm border border-gray-50 hover:shadow-2xl transition-all duration-500 flex flex-col h-full">
                <div class="relative rounded-[1rem] overflow-hidden h-[250px] mb-6">
                    <img src="{{ $produk->foto ? asset('storage/' . $produk->foto) : '' }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="{{ $produk->nama }}">
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-4 py-1 rounded-full text-[10px] font-black text-primary uppercase shadow-sm">{{ $produk->ukuran }}</div>
                </div>
                <div class="px-4 pb-4 flex-grow">
                    <h3 class="text-xl font-black text-gray-800 mb-2">{{ $produk->nama }}</h3>
                    <p class="text-xs text-gray-400 leading-relaxed mb-6 line-clamp-2 italic">{{ $produk->kategori }}</p>
                    <div class="mt-auto flex items-center justify-between border-t border-gray-50 pt-6">
                        <p class="text-sm font-bold text-primary uppercase tracking-widest italic">Kualitas Premium</p>
                        <a href="{{ route('detailProduk', $produk->id) }}" class="bg-primary text-white px-6 py-2.5 rounded-2xl shadow-lg hover:scale-110 transition active:scale-95 font-bold text-xs uppercase tracking-widest">
                        Lihat
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-32 bg-primary rounded-[2rem] p-12 text-center text-white shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-32 -mt-32"></div>
            <h2 class="text-3xl md:text-4xl font-black mb-6 uppercase tracking-tighter">Butuh Penawaran Khusus Proyek?</h2>
            <p class="opacity-80 mb-10 max-w-xl mx-auto">Dapatkan harga grosir dan jadwal pengiriman ritase besar untuk kebutuhan korporasi dan tender infrastruktur.</p>
            <a href="{{ route('pemesanan') }}" class="bg-yellow-400 text-gray-900 px-12 py-4 rounded-2xl font-black uppercase tracking-widest text-sm hover:scale-105 transition shadow-xl inline-block">Hubungi Sales Manager</a>
        </div>
    </main>

    @include('footer')

</body>

</html>