<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami | PT Conbloc Indotama Quarry</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <style>
        :root { --primary: #005f37; }
        .text-primary { color: var(--primary); }
        .bg-primary { background-color: var(--primary); }
    </style>
</head>
<body class="bg-[#fdfbf7] antialiased">

    @include('navbar')
<header class="relative h-[300px] flex items-center justify-center overflow-hidden rounded-b-[3rem] md:rounded-b-[5rem]">
    <div class="absolute inset-0 z-0">
        <img src="img/batu.jpg" class="w-full h-full object-cover grayscale brightness-[0.4]" alt="Background About">
    </div>
    
    <div class="relative z-10 text-center">
        <h1 class="text-3xl md:text-5xl font-black text-white uppercase ">Tentang Kami</h1>
        <div class="w-16 h-1 bg-white mx-auto mt-4 opacity-50"></div>
    </div>
</header>

<section class="max-w-4xl mx-auto px-6 py-16 text-center">
    <p class="text-gray-600 leading-relaxed text-lg md:text-xl font-medium italic">
        "Penyedia batu split berkualitas tinggi dengan dukungan teknologi mesin impor dan SDM berpengalaman untuk memenuhi kebutuhan konstruksi nasional Anda."
    </p>
</section>

<section class="max-w-6xl mx-auto px-6 mb-24">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="aspect-square rounded-xl overflow-hidden shadow-sm">
            <img src="img/batu.jpg" class="w-full h-full object-cover hover:scale-110 transition duration-500">
        </div>
        <div class="aspect-square rounded-xl overflow-hidden shadow-sm">
            <img src="img/batu1.jpg" class="w-full h-full object-cover hover:scale-110 transition duration-500">
        </div>
        <div class="aspect-square rounded-xl overflow-hidden shadow-sm">
            <img src="img/batu2.jpg" class="w-full h-full object-cover hover:scale-110 transition duration-500">
        </div>
        <div class="aspect-square rounded-xl overflow-hidden shadow-sm">
            <img src="img/profilpt.jpg" class="w-full h-full object-cover hover:scale-110 transition duration-500">
        </div>
    </div>
</section>

    <section class="max-w-7xl mx-auto px-6 mb-32">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-20 items-center">
            <div class="space-y-6">
                <h2 class="text-3xl md:text-5xl font-black text-gray-800 leading-tight">
                    <span class="text-black"> PT Conbloc Indotama <br> Quarry (CIQ)</span>
                </h2>
                <div class="w-20 h-2 bg-black"></div>
            </div>
            <div class="space-y-6 text-gray-600 leading-relaxed">
                <p>
                    PT Conbloc Indotama Quarry (CIQ) merupakan salah satu perusahaan besar yang bergerak sebagai penyedia batu split. Kami siap melayani dan memberikan konsultasi profesional untuk setiap kebutuhan pembelian batu split proyek Anda.
                </p>
                <p>
                    Sebagai komponen vital dalam konstruksi, batu split CIQ diproduksi dengan standar kualitas tinggi yang teruji di Indonesia, bersumber dari daerah-daerah dengan kualitas material terbaik.
                </p>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 mb-32">
        <div class="bg-white rounded-[3rem] p-8 md:p-16 shadow-sm border border-gray-100 grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <div class="relative">
                <div class="rounded-[1rem] overflow-hidden shadow-2xl">
                    <img src="img/profilpt.jpg" class="w-full h-[400px] object-cover" alt="Founder/Workplace">
                </div>
                <div class="absolute -bottom-6 -right-6 md:right-12 bg-white p-6 rounded-xl shadow-xl max-w-xs border-l-4 border-primary">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Visi Kami</p>
                    <p class="text-gray-800 italic font-medium">"Menjadi pilar utama penyedia material konstruksi berkualitas nasional."</p>
                </div>
            </div>
            
            <div class="space-y-10">
                <h3 class="text-3xl font-black text-gray-800">Kenapa Memilih Kami?</h3>
                
                <div class="space-y-8">
                    <div class="flex gap-6">
                        <div class="shrink-0 w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined">groups</span>
                        </div>
                        <div>
                            <h4 class="font-black text-gray-800 mb-2 uppercase tracking-wider text-sm">Sumber Daya Manusia</h4>
                            <p class="text-gray-500 text-sm leading-relaxed">SDM kami sangat berpengalaman dalam alur proses produksi, berfokus pada QC ketat dan ketepatan kerja tinggi.</p>
                        </div>
                    </div>

                    <div class="flex gap-6">
                        <div class="shrink-0 w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined">precision_manufacturing</span>
                        </div>
                        <div>
                            <h4 class="font-black text-gray-800 mb-2 uppercase tracking-wider text-sm">Mesin Produksi</h4>
                            <p class="text-gray-500 text-sm leading-relaxed">Menggunakan mesin-mesin impor yang mempunyai standar mutu internasional untuk menjamin kualitas material.</p>
                        </div>
                    </div>

                    <div class="flex gap-6">
                        <div class="shrink-0 w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined">apartment</span>
                        </div>
                        <div>
                            <h4 class="font-black text-gray-800 mb-2 uppercase tracking-wider text-sm">Kepercayaan Nasional</h4>
                            <p class="text-gray-500 text-sm leading-relaxed">Dipercaya oleh berbagai perusahaan besar nasional di bidang konstruksi dan sipil di seluruh Indonesia.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('footer')

</body>
</html>