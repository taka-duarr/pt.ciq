<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program CSR | PT Conbloc Indotama Quarry</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        :root { --primary: #005f37; }
        .text-primary { color: var(--primary); }
        .bg-primary { background-color: var(--primary); }
    </style>
</head>
<body class="bg-[#fdfbf7] antialiased">

    @include('navbar')

    <header class="relative h-[400px] flex items-center justify-center overflow-hidden rounded-b-[3rem] md:rounded-b-[5rem]">
        <div class="absolute inset-0 z-0">
            <img src="img/batu.jpg" class="w-full h-full object-cover brightness-[0.3]" alt="CSR Background">
        </div>
        
        <div class="relative z-10 text-center px-6">
            <p class="text-white/70 uppercase tracking-[0.3em] text-xs font-bold mb-4">Social Responsibility</p>
            <h1 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tight">Program CSR</h1>
            <div class="w-20 h-1 bg-white mx-auto mt-6 opacity-50"></div>
        </div>
    </header>

    <section class="max-w-4xl mx-auto px-6 py-20">
        <div class="text-center space-y-6">
            <h2 class="text-2xl md:text-3xl font-black text-gray-800 uppercase italic">Program CSR yang Berkelanjutan</h2>
            <p class="text-gray-600 leading-relaxed text-lg italic">
                "Kami sadar bahwa pembangunan suatu negara bukan hanya tanggung jawab pemerintah saja, setiap insan manusia berperan untuk mewujudkan kesejahteraan sosial dan peningkatan kualitas hidup masyarakat."
            </p>
            <div class="pt-8 text-gray-500 leading-relaxed text-sm md:text-base space-y-4">
                <p>
                    Dunia usaha berperan untuk mendorong pertumbuhan ekonomi yang sehat dengan mempertimbangkan aspek sosial dan aspek lingkungan. Dua elemen ini merupakan kunci dari konsep pembangunan berkelanjutan.
                </p>
                <p>
                    PT. Conbloc Indotama Quarry salah satu perusahaan yang sangat mengerti dan peduli dengan keadaan sekitar dengan berbagi bersama.
                </p>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 pb-32">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-gray-100 hover:shadow-xl transition-all group">
                <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:bg-primary  transition-colors">
                    <span class="material-symbols-outlined text-3xl">engineering</span>
                </div>
                <h3 class="font-black text-gray-800 uppercase tracking-wider text-sm mb-4">Rekrutmen Lokal</h3>
                <p class="text-gray-500 text-xs leading-relaxed">Rekrutmen SDM yang berkualitas dari warga sekitar lokasi tempat perusahaan berdiri dan beroperasi.</p>
            </div>

            <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-gray-100 hover:shadow-xl transition-all group">
                <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:bg-primary transition-colors">
                    <span class="material-symbols-outlined text-3xl">school</span>
                </div>
                <h3 class="font-black text-gray-800 uppercase tracking-wider text-sm mb-4">Pendidikan Karyawan</h3>
                <p class="text-gray-500 text-xs leading-relaxed">Program pendidikan untuk karyawan yang berprestasi ke level professional untuk pengembangan karir.</p>
            </div>

            <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-gray-100 hover:shadow-xl transition-all group">
                <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:bg-primary  transition-colors">
                    <span class="material-symbols-outlined text-3xl">water_drop</span>
                </div>
                <h3 class="font-black text-gray-800 uppercase tracking-wider text-sm mb-4">Air Bersih</h3>
                <p class="text-gray-500 text-xs leading-relaxed">Pendistribusian air bersih secara rutin kepada warga di sekitar area operasional perusahaan.</p>
            </div>

            <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-gray-100 hover:shadow-xl transition-all group">
                <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:bg-primary  transition-colors">
                    <span class="material-symbols-outlined text-3xl">redeem</span>
                </div>
                <h3 class="font-black text-gray-800 uppercase tracking-wider text-sm mb-4">Bingkisan Tahunan</h3>
                <p class="text-gray-500 text-xs leading-relaxed">Pendistribusian bingkisan setiap tahun kepada warga sekitar sebagai bentuk rasa syukur dan kepedulian.</p>
            </div>

            <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-gray-100 hover:shadow-xl transition-all group">
                <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:bg-primary  transition-colors">
                    <span class="material-symbols-outlined text-3xl">handshake</span>
                </div>
                <h3 class="font-black text-gray-800 uppercase tracking-wider text-sm mb-4">Pemberdayaan Ekonomi</h3>
                <p class="text-gray-500 text-xs leading-relaxed">Memberikan kesempatan kepada warga sekitar untuk ikut serta dalam aktivitas pemasaran produk perusahaan.</p>
            </div>

            <div class="bg-primary p-8 rounded-[3rem] text-white shadow-2xl flex flex-col justify-center">
                <h3 class="text-xl font-black mb-4 italic leading-tight">Membangun Bersama Masyarakat</h3>
                <p class="text-xs opacity-70 leading-relaxed">Kami terus berkomitmen untuk tumbuh bersama lingkungan dan masyarakat demi masa depan Indonesia yang lebih baik.</p>
            </div>
        </div>
    </section>

    @include('footer')

</body>
</html>