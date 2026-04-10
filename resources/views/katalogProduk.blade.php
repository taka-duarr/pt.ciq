<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk | PT Conbloc Indotama Quarry</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
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

    <header class="py-16 bg-white border-b border-gray-100  pt-24">
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

    <main class="max-w-7xl mx-auto px-6 py-20 ">
        <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @foreach ($produks as $produk)
                <div
                    class="group bg-white p-4 rounded-[1rem] shadow-sm border border-gray-50 hover:shadow-2xl transition-all duration-500 flex flex-col h-full">
                    <div class="relative rounded-[1rem] overflow-hidden h-[250px] mb-6">
                        <img src="{{ $produk->foto ? asset('storage/' . $produk->foto) : '' }}"
                            class="w-full h-full object-cover transition duration-700 group-hover:scale-110"
                            alt="{{ $produk->nama }}">
                        <div
                            class="absolute top-4 right-4 bg-white/90 backdrop-blur px-4 py-1 rounded-full text-[10px] font-black text-primary uppercase shadow-sm">
                            {{ $produk->ukuran }}</div>
                    </div>
                    <div class="px-4 pb-4 flex-grow">
                        <h3 class="text-xl font-black text-gray-800 mb-2">{{ $produk->nama }}</h3>



                        <div class="mt-auto flex items-center justify-end border-t border-gray-50 pt-4">
                            <a href="{{ route('detailProduk', $produk->id) }}"
                                class="bg-primary text-white px-8 py-3 rounded-xl shadow-lg hover:scale-110 transition active:scale-95 font-bold text-xs uppercase tracking-widest">
                                Pesan
                            </a>
                        </div>
                        <!-- NOTE -->
                        <p class="text-[10px] text-gray-500 italic mb-3 mt-6">
                            <span class="text-red-500 ">*</span>Tekan tombol untuk melakukan pembelian
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-32 bg-primary rounded-[1rem] p-12 text-center text-white shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-32 -mt-32"></div>
            <h2 class="text-3xl md:text-4xl font-black mb-6 uppercase tracking-tighter">Butuh Penawaran Khusus Proyek?
            </h2>
            <p class="opacity-80 mb-10 max-w-xl mx-auto">Dapatkan harga grosir dan jadwal pengiriman ritase besar untuk
                kebutuhan korporasi dan tender infrastruktur.</p>
            <a href="https://wa.me/6281252142002" target="_blank"
                class="bg-yellow-400 text-gray-900 px-12 py-4 rounded-xl font-black uppercase tracking-widest text-sm hover:scale-105 transition shadow-xl inline-block">Hubungi
                Customer Information </a>
        </div>
    </main>

    @include('footer')

</body>

</html>
