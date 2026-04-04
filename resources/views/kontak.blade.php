<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami | PT Conbloc Indotama Quarry</title>
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

<body class="bg-[#f8fafc] antialiased ">

    @include('navbar')

    <main class="max-w-7xl mx-auto px-6 mt-12  pt-24">

        <div class="text-center mb-16">
            <span
                class="px-6 py-2 border border-gray-200 rounded-full text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 mb-6 inline-block">Contact
                Us</span>
            <h1 class="text-4xl md:text-5xl font-black text-gray-800 tracking-tight">
                Hubungi Kami, Beritahu Apa <br> yang Bisa <span class="text-primary">Kami Bantu</span>
            </h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">

    <!-- Email -->
    <div
        class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-50 flex flex-col items-center text-center gap-4 group hover:shadow-xl transition-all">
        <div
            class="w-14 h-14 bg-primary rounded-2xl flex items-center justify-center text-white shadow-lg shadow-green-900/20 group-hover:scale-110 transition">
            <span class="material-symbols-outlined">mail</span>
        </div>
        <div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Email Address</p>
            <p class="text-gray-800 font-bold text-sm">quarryconbloc@gmail.com</p>
            <p class="text-gray-800 font-bold text-sm">abilerwin@gmail.com</p>
        </div>
    </div>

    <!-- Phone -->
    <div
        class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 flex flex-col items-center text-center gap-4 group hover:shadow-xl transition-all">
        <div
            class="w-14 h-14 bg-primary rounded-2xl flex items-center justify-center text-white shadow-lg shadow-green-900/20 group-hover:scale-110 transition">
            <span class="material-symbols-outlined">call</span>
        </div>
        <div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Phone Number</p>
            <p class="text-gray-800 font-bold text-sm">+6281252142002</p>
        </div>
    </div>

    <!-- Lokasi 1 -->
    <div
        class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 flex flex-col items-center text-center gap-4 group hover:shadow-xl transition-all h-full">
        <div
            class="w-14 h-14 bg-primary rounded-2xl flex items-center justify-center text-white shadow-lg shadow-green-900/20 group-hover:scale-110 transition shrink-0">
            <span class="material-symbols-outlined">location_on</span>
        </div>

        <div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Lokasi Query</p>
            <p class="text-gray-800 font-bold text-xs leading-relaxed break-words">
                Dusun Karanganyar Timur, Desa Karangasem, Kecamatan Lumbang, Kabupaten Pasuruan - Jawa Timur
            </p>
        </div>
    </div>

    <!-- Lokasi 2 -->
    <div
        class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 flex flex-col items-center text-center gap-4 group hover:shadow-xl transition-all h-full">
        <div
            class="w-14 h-14 bg-primary rounded-2xl flex items-center justify-center text-white shadow-lg shadow-green-900/20 group-hover:scale-110 transition shrink-0">
            <span class="material-symbols-outlined">location_on</span>
        </div>

        <div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Marketing Office</p>
            <p class="text-gray-800 font-bold text-xs leading-relaxed break-words">
                Gedung Sentra Niaga Utama Citraland Surabaya
            </p>
        </div>
    </div>

</div>

        <div
            class="bg-white rounded-[3rem] p-4 md:p-10 shadow-sm border border-gray-50 grid grid-cols-1 lg:grid-cols-2 gap-12">

            <div class="rounded-[1rem] overflow-hidden border-4 border-gray-50 h-[400px] lg:h-full relative group">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14660.219317972958!2d112.95595566897875!3d-7.756104002595984!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7cb2f696c9559%3A0xc1f427709eba01f6!2sPT.%20Conbloc%20indotama%20Quarry%20(crushing%20plant)!5e1!3m2!1sid!2sid!4v1772532723847!5m2!1sid!2sid"
                    class="w-full h-full border-0 grayscale group-hover:grayscale-0 transition-all duration-700"
                    allowfullscreen="" loading="lazy"></iframe>
                <div
                    class="absolute bottom-6 left-6 right-6 bg-white/90 backdrop-blur p-4 rounded-2xl shadow-2xl flex items-center gap-4 border border-white">
                    <div class="bg-primary text-white p-2 rounded-lg"><span
                            class="material-symbols-outlined">distance</span></div>
                    <p class="text-[10px] font-bold text-gray-600 uppercase">Lokasi Conbloc Quarry Indotama</p>
                </div>
            </div>

            <div class="py-4 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Your
                            Name</label>
                        <input type="text" placeholder="Nama lengkap..."
                            class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-primary transition shadow-inner">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Company
                            Name</label>
                        <input type="text" placeholder="Nama perusahaan..."
                            class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-primary transition shadow-inner">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Email
                        address</label>
                    <input type="email" placeholder="alamat@email.com"
                        class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-primary transition shadow-inner">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Message</label>
                    <textarea placeholder="Tulis pesan Anda di sini..."
                        class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl h-40 outline-none focus:border-primary transition shadow-inner resize-none"></textarea>
                </div>

                <button
                    class="w-full bg-primary text-white py-5 rounded-2xl font-black uppercase tracking-[0.2em] shadow-xl shadow-green-900/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-3">
                    Kirim Pesan

                </button>
            </div>
        </div>

    </main>

    @include('footer')

</body>

</html>
