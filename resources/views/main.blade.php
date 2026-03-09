<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perusahaan Batu Split</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=shopping_cart" />
    <link rel="icon" type="img/logo.png" href="img/logo.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=print" />
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <style>
        * {
            font-family: 'DM Sans', sans-serif;
        }

        /* warna hijau dominan perusahaan */
        :root {
            --primary: #005f37;
        }

        .hero-bg {
            background: linear-gradient(135deg, rgba(0, 95, 55, 0.55) 0%, rgba(0, 95, 55, 0.2) 100%),
                url('batu.jpg') center/cover no-repeat;
        }

        .stat-card-2 {
            background: linear-gradient(135deg, rgba(0, 95, 55, 0.35) 0%, rgba(0, 95, 55, 0.15) 100%),
                url('batu.jpg') center/cover no-repeat;
        }

        .stat-card-3 {
            background: var(--primary);
        }

        .nav-underline::after {
            background: var(--primary);
        }

        .btn-search {
            background: var(--primary);
        }

        .btn-search:hover {
            background: #00472a;
        }

        @keyframes bounce-slow {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-bounce-slow {
            animation: bounce-slow 3s infinite ease-in-out;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">

    @include('navbar')

    <!-- Main Content -->
    <main class="px-4 md:px-8 pb-8">

        <!-- Hero Section -->
        <div class="flex flex-col md:flex-row items-center justify-between gap-10 py-10 px-4 md:px-0">

            <div class="w-full md:w-1/2 space-y-6">
                <div class="flex items-center gap-2">
                    <span class="w-8 h-8 bg-[var(--primary)] rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM5.05 6.464A1 1 0 106.464 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zM5 10a1 1 0 01-1 1H3a1 1 0 110-2h1a1 1 0 011 1zM8 16v-1a1 1 0 112 0v1a1 1 0 11-2 0zM13.536 15.657a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414l.707.707z"></path>
                        </svg>
                    </span>
                    <p class="text-[var(--primary)] font-bold tracking-wider text-sm uppercase">Tingkatkan Proyek Anda Bersama Kami</p>
                </div>

                <h1 class="text-4xl md:text-6xl font-black text-gray-800 leading-tight">
                    Berdayakan Konstruksi Anda dengan <span class="text-[var(--primary)]">Batu Split Premium</span>
                </h1>

                <p class="text-gray-500 text-lg leading-relaxed max-w-lg">
                    Kualitas material terbaik yang diproses dengan teknologi terkini untuk memastikan ketahanan struktur bangunan Anda. Siap kirim ke seluruh daerah.
                </p>

                <div class="flex items-center gap-6 pt-4">
                    <button class="bg-[var(--primary)] text-white px-8 py-4 rounded-full font-bold shadow-xl shadow-green-900/20 hover:scale-105 transition flex items-center gap-2">
                        Eksplorasi Produk <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </button>
                    <a href="#" class="font-bold text-gray-700 hover:text-[var(--primary)] underline decoration-2 underline-offset-8">Lihat Semua Layanan</a>
                </div>
            </div>

            <div class="w-full md:w-1/2 relative flex items-center justify-end">
                <div class="grid grid-cols-2 gap-4 w-full max-w-md">
                    <div class="row-span-2 relative rounded-xl overflow-hidden shadow-2xl h-[400px]">
                        <img src="img/batu.jpg" class="w-full h-full object-cover" alt="Batu Premium">
                        <div class="absolute bottom-6 -right-6 bg-white p-2 rounded-full shadow-lg">

                        </div>
                    </div>

                    <div class="rounded-lg overflow-hidden  shadow-xl h-[190px]">
                        <img src="img/batu1.jpg" class="w-full h-full object-cover" alt="Proses Batu">
                    </div>

                    <div class="rounded-xl overflow-hidden  shadow-xl h-[190px] relative">
                        <img src="img/batu2.jpg" class="w-full h-full object-cover" alt="Produk Batu">
                        <div class="absolute bottom-4 right-4 text-yellow-400">

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- About -->
        <section class="py-20 px-6 md:px-12 max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row items-center justify-between gap-12 md:gap-20">

                <div class="w-full md:w-1/2 relative order-2 md:order-1">
                    <div class="absolute -bottom-6 -left-6 w-24 h-24 opacity-10 z-0">
                        <svg viewBox="0 0 100 100" class="w-full h-full text-[var(--primary)]">
                            <pattern id="dots-about" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                <circle cx="2" cy="2" r="2" fill="currentColor" />
                            </pattern>
                            <rect width="100" height="100" fill="url(#dots-about)" />
                        </svg>
                    </div>

                    <div class="relative z-10">
                        <div class="rounded-[3.5rem] overflow-hidden shadow-2xl h-[450px] border-[2px] border-white">
                            <img src="img/profilpt.jpg" class="w-full h-full object-cover" alt="PT Conbloc Indotama Quarry">
                        </div>

                        <div class="absolute -top-4 -right-4 w-20 h-20 border-t-4 border-r-4 border-[var(--primary)] rounded-tr-[2rem] opacity-30"></div>
                    </div>
                </div>

                <div class="w-full md:w-1/2 space-y-6 order-1 md:order-2">
                    <div class="flex items-center gap-3">
                        <span class="w-12 h-[2px] bg-[var(--primary)]"></span>
                        <p class="text-[var(--primary)] font-bold tracking-widest text-xs uppercase">Tentang Kami</p>
                    </div>

                    <h2 class="text-4xl md:text-5xl font-black text-gray-800 leading-tight">
                        Penyedia Utama <br>
                        <span class="text-[var(--primary)]">Batu Split Berkualitas</span>
                    </h2>

                    <div class="relative">
                        <p class="text-gray-600 text-lg leading-relaxed border-l-4 border-[var(--primary)] pl-6 italic">
                            PT Conbloc Indotama Quarry merupakan salah satu perusahaan besar yang bergerak sebagai penyedia batu split, siap melayani dan memberikan konsultasi untuk pembelian batu split.
                        </p>
                    </div>

                    <div class="pt-6">
                        <button class="bg-[var(--primary)] text-white px-10 py-4 rounded-full font-bold shadow-lg shadow-green-900/20 hover:bg-[#004c2c] transition-all flex items-center gap-3 group">
                            Pelajari Selengkapnya
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
        </section>
        <!-- Stats Row -->
        <div class="mb-10">
            <div class="flex items-center gap-3 mb-2">
                <span class="w-8 h-[2px] bg-[var(--primary)]"></span>
                <p class="text-[var(--primary)] font-bold tracking-widest text-xs uppercase">Pilihan Material</p>
            </div>
            <h2 class="text-3xl md:text-4xl font-black text-gray-800 leading-tight max-w-xl">
                Beberapa Produk Unggulan Untuk <span class="text-[var(--primary)]">Konstruksi Anda</span>
            </h2>
        </div>

        <div id="product-slider" class="flex overflow-x-auto gap-8 pb-8 snap-x snap-mandatory hide-scrollbar">
            @foreach($produks as $produk)
            <div class="group cursor-pointer min-w-[280px] md:min-w-[320px] snap-center shrink-0">
                <div class="relative rounded-[1rem] overflow-hidden shadow-sm h-[220px] border border-gray-100">
                    <img src="{{ $produk->foto ? asset('storage/' . $produk->foto) : '' }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="{{ $produk->nama }}">
                </div>
                <div class="mt-4 px-2 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">{{ $produk->nama }}</h3>
                        <p class="text-[var(--primary)] font-bold mt-1 text-sm">Rp {{ number_format($produk->harga, 0, ',', '.') }} / Ton</p>
                    </div>
                    <a href="{{ route('detailProduk', $produk->id) }}" class="bg-[var(--primary)] text-white px-5 py-2.5 rounded-2xl flex items-center gap-2 shadow-lg shadow-green-900/20 hover:bg-[#004c2c] transition-all transform active:scale-95">
                        <span class="text-xs font-bold uppercase tracking-wider">Beli</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        
        <style>
            /* Hide scrollbar for Chrome, Safari and Opera */
            .hide-scrollbar::-webkit-scrollbar {
                display: none;
            }
            /* Hide scrollbar for IE, Edge and Firefox */
            .hide-scrollbar {
                -ms-overflow-style: none;  /* IE and Edge */
                scrollbar-width: none;  /* Firefox */
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const slider = document.getElementById('product-slider');
                let scrollAmount = 0;
                let scrollInterval;

                const startAutoScroll = () => {
                    scrollInterval = setInterval(() => {
                        if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 10) {
                            // Reset to start if reached the end
                            slider.scrollTo({ left: 0, behavior: 'smooth' });
                            scrollAmount = 0;
                        } else {
                            // Scroll by the width of one card + gap (approx 350px)
                            scrollAmount += 350; 
                            slider.scrollTo({ left: scrollAmount, behavior: 'smooth' });
                        }
                    }, 3000); // 3 seconds interval
                };

                const stopAutoScroll = () => {
                    clearInterval(scrollInterval);
                };

                // Start initially
                startAutoScroll();

                // Pause on hover
                slider.addEventListener('mouseenter', stopAutoScroll);
                slider.addEventListener('mouseleave', startAutoScroll);

                // Pause on touch (mobile)
                slider.addEventListener('touchstart', stopAutoScroll);
                slider.addEventListener('touchend', startAutoScroll);
            });
        </script>
    </main>
    <!-- Cara Pemesanan -->
    <section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-6">

        <div class="text-center mb-20">
            <h2 class="text-3xl md:text-4xl font-black text-gray-800 uppercase tracking-widest">
                Bagaimana Cara Memesannya?
            </h2>
            <div class="w-24 h-1 bg-[var(--primary)] mx-auto mt-4 mb-4"></div>
            <p class="text-gray-500 font-medium">
                Perhatikan langkah-langkah di bawah ini untuk memastikan pesanan Anda terdata dengan benar.
            </p>
        </div>

        <div class="relative">
            <div class="absolute left-1/2 transform -translate-x-1/2 h-full border-l-2 border-dotted border-gray-300 z-0 hidden md:block"></div>

            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between mb-24 group">
                <div class="w-full md:w-[45%] text-center md:text-right order-2 md:order-1 mt-8 md:mt-0">
                    <h3 class="text-2xl font-black text-[var(--primary)] mb-4">Pilih Produk</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Jelajahi katalog kami dan tentukan jenis <span class="font-bold">Batu Split</span> atau <span class="font-bold">Abu Batu</span> serta tentukan jumlah <span class="font-bold">Tonase</span> yang dibutuhkan.
                    </p>
                </div>
                <div class="w-full md:w-[10%] flex flex-col items-center order-1 md:order-2">
                    <span class="text-xs font-bold text-gray-400 uppercase mb-1">Step</span>
                    <span class="text-4xl font-black text-gray-800">01</span>
                </div>
                <div class="w-full md:w-[45%] flex justify-center md:justify-start order-3 mt-8 md:mt-0">
                    <div class="w-48 h-48 rounded-full bg-red-500 flex items-center justify-center border-[8px] border-gray-50 shadow-xl overflow-hidden p-4">
                        <img src="img/rock.png" class="w-20 h-20 object-contain" alt="Pilih Batu">
                    </div>
                </div>
            </div>

            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between mb-24 group">
                <div class="w-full md:w-[45%] flex justify-center md:justify-end order-3 md:order-1 mt-8 md:mt-0">
                    <div class="w-48 h-48 rounded-full bg-[var(--primary)] flex items-center justify-center border-[8px] border-gray-50 shadow-xl overflow-hidden p-6">
                        <img src="img/shopping-cart.png" class="w-20 h-20 object-contain" alt="Keranjang">
                    </div>
                </div>
                <div class="w-full md:w-[10%] flex flex-col items-center order-1 md:order-2">
                    <span class="text-xs font-bold text-gray-400 uppercase mb-1">Step</span>
                    <span class="text-4xl font-black text-gray-800">02</span>
                </div>
                <div class="w-full md:w-[45%] text-center md:text-left order-2 md:order-3 mt-8 md:mt-0">
                    <h3 class="text-2xl font-black text-[var(--primary)] mb-4">Isi Data & Hitung</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Lengkapi formulir yang tersedia mulai dari data diri hingga lokasi proyek. Klik tombol <span class="bg-[var(--primary)] text-white px-2 py-0.5 rounded text-xs font-bold uppercase">Hitung Estimasi</span> untuk melihat rincian biaya.
                    </p>
                </div>
            </div>

            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between mb-24 group">
                <div class="w-full md:w-[45%] text-center md:text-right order-2 md:order-1 mt-8 md:mt-0">
                    <h3 class="text-2xl font-black text-[var(--primary)] mb-4">Pesan & Print Struk</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Klik <span class="font-bold uppercase tracking-tight">Pesan Sekarang</span> untuk memproses pesanan. Pastikan Anda melakukan <span class="font-bold">Print Struk</span> (Cetak Faktur) sebagai bukti pemesanan sah dari sistem kami.
                    </p>
                </div>
                <div class="w-full md:w-[10%] flex flex-col items-center order-1 md:order-2">
                    <span class="text-xs font-bold text-gray-400 uppercase mb-1">Step</span>
                    <span class="text-4xl font-black text-gray-800">03</span>
                </div>
                <div class="w-full md:w-[45%] flex justify-center md:justify-start order-3 mt-8 md:mt-0">
                    <div class="w-48 h-48 rounded-full bg-yellow-500 flex items-center justify-center border-[8px] border-gray-50 shadow-xl overflow-hidden p-8">
                        <img src="img/printer.png" class="w-20 h-20 object-contain" alt="Cetak Faktur">
                    </div>
                </div>
            </div>

            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between group">
                <div class="w-full md:w-[45%] flex justify-center md:justify-end order-3 md:order-1 mt-8 md:mt-0">
                    <div class="w-48 h-48 rounded-full bg-green-600 flex items-center justify-center border-[8px] border-gray-50 shadow-xl overflow-hidden p-6">
                        <img src="img/whatsapp.png" class="w-20 h-20 object-contain" alt="WhatsApp">
                    </div>
                </div>
                <div class="w-full md:w-[10%] flex flex-col items-center order-1 md:order-2">
                    <span class="text-xs font-bold text-gray-400 uppercase mb-1">Step</span>
                    <span class="text-4xl font-black text-gray-800">04</span>
                </div>
                <div class="w-full md:w-[45%] text-center md:text-left order-2 md:order-3 mt-8 md:mt-0">
                    <h3 class="text-2xl font-black text-green-600 mb-4 text-primary">Finalisasi Pembayaran</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Anda akan diarahkan ke WhatsApp admin. Lakukan transfer sesuai nominal di struk, kemudian <span class="font-bold">Kirim Bukti Pembayaran</span> melalui WhatsApp untuk konfirmasi jadwal pengiriman armada.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>
    <!-- FOOTER -->
    @include('footer')
</body>

</html>