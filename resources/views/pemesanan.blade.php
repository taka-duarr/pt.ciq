<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Material Batu | PT Conbloc Indotama</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="img/logo.png" href="img/logo.png">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <style>
        :root {
            --primary: #005f37;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        .bg-primary {
            background-color: var(--primary);
        }

        .text-primary {
            color: var(--primary);
        }

        .border-primary {
            border-color: var(--primary);
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 antialiased pb-20">

    <header class="bg-white border-b sticky top-0 z-40 no-print opacity-80">
    <div class="max-w-7xl mx-auto px-6 h-20 grid grid-cols-3 items-center ">
        
        <div class="flex items-center">
            <div class="p-2 rounded-lg">
                <img src="img/logo1.png" class="h-8 w-auto" alt="Logo">
            </div>
        </div>

        <div class="text-center">
            <h1 class="text-lg md:text-xl font-extrabold tracking-tight text-gray-900 uppercase">
                Simulasi Harga Loco / Franco
            </h1>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('home') }}" class="flex items-center gap-2 px-4 py-2 bg-gray-50 text-gray-700 hover:text-primary hover:bg-primary/5 border border-gray-200 rounded-xl font-bold text-xs transition-all group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span class="hidden sm:inline">Kembali ke Beranda</span>
                <span class="sm:hidden">Kembali</span>
            </a>
        </div>
        
    </div>
</header>

    <main class="max-w-7xl mx-auto px-6 mt-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            <div class="lg:col-span-8 space-y-8">

                <section class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 no-print">
                    <h3 class="text-lg font-bold mb-6 flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-primary rounded-full"></span> 1. Informasi Pemesan
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase">Nama Pemesan</label>
                            <input type="text" id="inputNama" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:border-primary transition" placeholder="Contoh: Andi Saputra">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase">Perusahaan / Kontraktor</label>
                            <input type="text" id="inputPerusahaan" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:border-primary transition" placeholder="Nama PT / CV">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase">Nomor WhatsApp</label>
                            <input type="tel" id="inputWA" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:border-primary transition" placeholder="0812xxxx">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase">Email (Opsional)</label>
                            <input type="email" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none" placeholder="alamat@email.com">
                        </div>
                    </div>
                </section>

                <section class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 no-print">
                    <h3 class="text-lg font-bold mb-6 flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-primary rounded-full"></span> 2. Detail Material
                    </h3>

                    @if($selectedProduk)
                        <div class="p-6 bg-primary/5 rounded-[1.5rem] border-2 border-primary/20 flex items-center justify-between group">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center text-white font-black">
                                    {{ substr($selectedProduk->nama, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Material Terpilih</p>
                                    <p class="font-black text-gray-800 text-lg sm:text-xl">{{ $selectedProduk->nama }}</p>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="selectedProductId" value="{{ $selectedProduk->id }}">
                        <input type="hidden" id="selectedProductName" value="{{ $selectedProduk->nama }}">
                    @else
                        <div id="productGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @foreach($produks as $produk)
                                <div onclick="selectProduct(this, {{ json_encode($produk) }})" 
                                    class="product-card p-4 rounded-2xl border-2 border-gray-100 bg-gray-50 cursor-pointer hover:border-primary/30 transition-all text-center group">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 group-hover:text-primary transition-colors">Material</p>
                                    <p class="font-bold text-gray-800 text-xs sm:text-sm leading-tight">{{ $produk->nama }}</p>
                                </div>
                            @endforeach
                        </div>
                        <input type="hidden" id="selectedProductId" value="">
                        <input type="hidden" id="selectedProductName" value="">
                    @endif

                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase">Harga Per Ton</label>
                            <div class="relative">
                                <div class="absolute left-4 top-1/2 -translate-y-1/2 font-bold text-gray-400 text-sm">Rp</div>
                                <input type="number" id="inputPrice" value="0" step="500" min="0" 
                                       class="w-full pl-12 pr-4 py-4 bg-gray-50 border-2 border-gray-200 rounded-2xl outline-none focus:border-primary text-xl font-black text-gray-800" 
                                       oninput="calculateOrder()">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase">Jumlah Pesanan (Ton)</label>
                            <div class="relative">
                                <input type="number" id="inputQty" value="0" step="0.1" min="0.1" 
                                       class="w-full px-4 py-4 bg-gray-50 border-2 border-gray-200 rounded-2xl outline-none focus:border-primary text-xl font-black text-gray-800 pr-16" 
                                       oninput="calculateOrder()">
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 font-bold text-gray-400 uppercase tracking-widest text-xs">Ton</div>
                            </div>
                        </div>
                    </div>


                    <div class="mt-8 p-6 bg-primary/5 rounded-2xl border border-primary/10 flex items-center justify-between">
                        <div class="flex items-center gap-4 text-primary font-bold">
                            <div class="bg-primary text-white p-3 rounded-xl shadow-lg flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h8a1 1 0 001-1z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 8h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-5" />
                                    <circle cx="5.5" cy="18.5" r="2.5" />
                                    <circle cx="15.5" cy="18.5" r="2.5" />
                                </svg>
                            </div>
                            <div class="relative">
                                <p class="text-[10px] uppercase tracking-wider opacity-70">Pilih Armada</p>
                                <!-- Custom Dropdown -->
                                <div class="relative mt-1">
                                    <button type="button" onclick="toggleArmadaDropdown()" id="armadaDropdownBtn" class="flex items-center gap-2 text-xl font-bold bg-transparent border-none outline-none cursor-pointer group">
                                        <span id="selectedArmadaLabel">Pilih Armada</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform group-focus:rotate-180" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    
                                    <div id="armadaOptions" class="hidden absolute top-full left-0 mt-2 w-72 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden z-[60] animate-fade-in">
                                        @forelse($armadas as $armada)
                                            <div onclick="selectArmada({{ json_encode($armada) }})" class="p-4 hover:bg-primary/5 cursor-pointer border-b last:border-none transition py-3">
                                                <p class="font-bold text-gray-800 text-sm">{{ $armada->nama }}</p>
                                                <p class="text-[10px] text-gray-500 font-medium uppercase tracking-tighter">Kapasitas: {{ $armada->minimal_ton }} - {{ $armada->maksimal_ton }} Ton</p>
                                            </div>
                                        @empty
                                            <div onclick="selectArmada({nama: 'Dump Truck Standard', maksimal_ton: 8})" class="p-4 hover:bg-primary/5 cursor-pointer transition">
                                                <p class="font-bold text-gray-800 text-sm">Dump Truck Standard</p>
                                                <p class="text-[10px] text-gray-500 font-medium uppercase tracking-tighter">Kapasitas: Up to 8 Ton</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                                <input type="hidden" id="selectedArmadaVal" value="">
                                <input type="hidden" id="selectedArmadaNama" value="">
                                <input type="hidden" id="selectedArmadaTarif" value="0">
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] uppercase font-bold text-gray-400 text-right">Dibutuhkan</p>
                            <p class="text-3xl font-black text-primary text-right"><span id="displayTrips">0</span> <span class="text-sm font-normal">Unit</span></p>
                        </div>
                    </div>
                </section>

                <section class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 no-print">
                    <h3 class="text-lg font-bold mb-6 flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-primary rounded-full"></span> 3. Lokasi Pengiriman
                    </h3>
                    <div class="space-y-4 mb-6">
                        
                            <label class="text-xs font-bold text-gray-500 uppercase flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="flex items-center gap-2">
                                    <span class="w-1.5 h-4 bg-primary rounded-full"></span>
                                    <span>Pilih Lokasi di Peta</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-primary font-black bg-primary/5 px-3 py-1.5 rounded-lg text-[11px] border border-primary/10" id="distanceLabel">Jarak: 0 km</span>
                                    <button onclick="getUserLocation()" type="button" class="group flex items-center gap-2 bg-primary text-white px-4 py-2 rounded-xl hover:bg-black transition-all shadow-md active:scale-95">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span class="text-[11px] font-extrabold uppercase tracking-tight">Gunakan Lokasi Saat Ini</span>
                                    </button>
                                </div>
                            </label>

                            <div class="relative group mt-4">
                                <div class="absolute top-4 left-4 right-4 z-[20] flex flex-col gap-1">
                                    <div class="flex gap-2">
                                        <input type="text" id="mapSearchInput" 
                                               class="flex-1 px-4 py-3 bg-white/95 backdrop-blur-sm border border-gray-200 rounded-xl shadow-2xl outline-none focus:border-primary text-sm placeholder:text-gray-400" 
                                               placeholder="Cari lokasi anda"
                                               oninput="onSearchInput(this.value)"
                                               onkeypress="if(event.key === 'Enter') { event.preventDefault(); searchLocation(); }">
                                        <button type="button" onclick="searchLocation()" class="bg-primary text-white p-3 rounded-xl shadow-lg hover:bg-black transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <!-- Suggestions Dropdown -->
                                    <div id="searchResults" class="hidden bg-white/95 backdrop-blur-sm border border-gray-100 rounded-xl shadow-2xl overflow-hidden animate-fade-in translate-y-1">
                                        <!-- Suggestions will be injected here -->
                                    </div>
                                </div>
                                <div id="map" class="w-full h-[450px] rounded-[2rem] border-4 border-white shadow-2xl z-[10]"></div>
                                <div id="search-spinner" class="hidden absolute inset-0 bg-white/50 backdrop-blur-[1px] z-[25] flex items-center justify-center rounded-[2rem]">
                                    <div class="px-6 py-3 bg-white rounded-2xl shadow-xl flex items-center gap-3 border border-gray-100">
                                        <div class="w-5 h-5 border-2 border-primary border-t-transparent rounded-full animate-spin"></div>
                                        <span class="text-xs font-bold text-gray-700">Mencari lokasi...</span>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="inputDistance" value="0">

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase">Wilayah Terdeteksi (Otomatis)</label>
                            <textarea id="autoAddress" readonly class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl h-20 outline-none text-sm font-medium text-gray-600" placeholder="Pilih lokasi di peta untuk mendeteksi wilayah..."></textarea>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase">Alamat Lengkap Pengiriman</label>
                            <textarea id="inputAlamat" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl h-24 outline-none" placeholder="Contoh: Jl. Raya No. 123, Depan Masjid..."></textarea>
                        </div>
                    </div>
                </section>

                <div id="invoiceSection" class="hidden">
                    <div id="printableInvoice" class="bg-white p-10 border-2 border-gray-200 rounded-[2rem] shadow-xl space-y-6">
                        <div class="flex justify-between border-b-2 border-black pb-4">
                            <div>
                                <img src="img/logo1.png" class="h-8 w-auto mb-1" alt="Logo Perusahaan">
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">Struk Estimasi B2B</p>
                            </div>
                            <div class="text-right text-xs">
                                <p class="font-bold">No: <span id="invId">#CIQ-0000</span></p>
                                <p id="invDate" class="text-gray-400 italic"></p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-8 text-[10px] sm:text-xs uppercase tracking-wider">
                            <div>
                                <p class="text-gray-400 font-bold mb-1">Kepada:</p>
                                <p id="invNama" class="font-bold text-gray-800 text-sm"></p>
                                <p id="invPerusahaan" class="text-gray-600"></p>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-400 font-bold mb-1">Tujuan Pengiriman:</p>
                                <p id="invAutoAddress" class="text-gray-600 text-[10px] leading-tight mb-1 whitespace-pre-line"></p>
                                <p id="invAlamat" class="text-gray-600 italic"></p>
                            </div>
                        </div>

                        <table class="w-full text-xs">
                            <thead class="bg-gray-100 font-black uppercase tracking-widest text-[10px]">
                                <tr>
                                    <th class="p-4 text-left">Deskripsi Material</th>
                                    <th class="p-4 text-center">Qty</th>
                                    <th class="p-4 text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="invTableBody" class="divide-y divide-gray-100">
                            </tbody>
                        </table>

                        <div class="space-y-2 text-right pt-4 border-t border-gray-100">
                            <p class="text-xs text-gray-500">Total Berat: <span id="invTotalWeight" class="font-bold text-gray-800">0</span> Ton</p>
                            <p class="text-xs text-gray-500">Biaya Kirim: <span id="invShippingCost" class="font-bold text-gray-800"></span> (<span id="invTrips">0</span> Unit <span id="invArmadaName"></span>)</p>
                            <p class="text-xs text-gray-500">PPN (11%): <span id="invPPN" class="font-bold text-gray-800"></span></p>
                            <div class="bg-primary text-white p-4 rounded-xl inline-block mt-4 shadow-lg">
                                <p class="text-[10px] uppercase opacity-70 mb-1">Total Tagihan Estimasi</p>
                                <p id="invTotalCost" class="text-2xl font-black"></p>
                            </div>
                        </div>
                    </div>
                    <button onclick="window.print()" class="w-full mt-4 py-4 bg-gray-800 text-white rounded-2xl font-bold uppercase tracking-widest hover:bg-black transition no-print">
                        Cetak Struk Pemesanan
                    </button>
                </div>
            </div>

            <div class="lg:col-span-4 no-print">
                <div class="bg-primary p-8 rounded-[1rem] text-white shadow-2xl sticky top-28 z-30">
                    <h3 class="text-lg font-bold mb-8 uppercase tracking-widest text-center">Ringkasan Estimasi</h3>

                    <div class="space-y-4 text-sm">
                        <div class="flex justify-between border-b border-white/10 pb-4">
                            <span class="opacity-70 text-[10px] uppercase">Total Berat</span>
                            <span class="font-bold"><span id="resTotalWeight">0</span> Ton</span>
                        </div>
                        <div class="flex justify-between border-b border-white/10 pb-4">
                            <span class="opacity-70 text-[10px] uppercase">Biaya Kirim</span>
                            <span class="font-bold" id="resShipping">Rp 0</span>
                        </div>
                        <div class="flex justify-between border-b border-white/10 pb-4">
                            <span class="opacity-70 text-[10px] uppercase">Jarak Estimasi</span>
                            <span class="font-bold"><span id="resDistance">0</span> KM</span>
                        </div>
                        <div class="flex justify-between border-b border-white/10 pb-4">
                            <span class="opacity-70 text-[10px] uppercase">PPN (11%)</span>
                            <span class="font-bold" id="resPPN">Rp 0</span>
                        </div>
                        <div class="pt-4 flex flex-col items-center">
                            <span class="opacity-70 uppercase tracking-wider text-[10px] mb-2 text-center">Total Pembayaran</span>
                            <span class="text-3xl font-black" id="resTotal">Rp 0</span>
                        </div>
                    </div>

                    <div class="mt-10 space-y-4">
                        <button onclick="updateInvoice()" class="w-full bg-white text-primary py-4 rounded-2xl font-black uppercase tracking-widest shadow-xl hover:scale-105 transition-all">
                            Hitung Estimasi
                        </button>
                        <button onclick="sendToWhatsApp()" class="w-full bg-yellow-400 text-gray-900 py-4 rounded-2xl font-black uppercase tracking-widest shadow-xl hover:scale-105 transition-all">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </main>

    @php
        $options = $produks->map(function($p) {
            return ['id' => $p->id, 'name' => $p->nama];
        })->values();
    @endphp
    
    <script id="material-options-data" type="application/json">
        {!! json_encode($options) !!}
    </script>

    <script>
        const materialOptions = JSON.parse(document.getElementById('material-options-data').textContent);

        // Jalankan baris material pertama saat load
        @if($selectedProduk)
        window.addEventListener('DOMContentLoaded', () => {
            initMap();
            calculateOrder(); 
        });
        @else
        window.onload = () => {
            initMap();
            const firstProductCard = document.querySelector('.product-card');
            if (firstProductCard) {
                const produkData = JSON.parse(firstProductCard.dataset.produk);
                selectProduct(firstProductCard, produkData);
            }
        };
        @endif

        function selectProduct(el, produk) {
            // Unselect all
            document.querySelectorAll('.product-card').forEach(card => {
                card.classList.remove('border-primary', 'bg-primary/5', 'ring-4', 'ring-primary/10');
                card.classList.add('border-gray-100', 'bg-gray-50');
            });

            // Select active
            el.classList.remove('border-gray-100', 'bg-gray-50');
            el.classList.add('border-primary', 'bg-primary/5', 'ring-4', 'ring-primary/10');

            document.getElementById('selectedProductId').value = produk.id;
            document.getElementById('selectedProductName').value = produk.nama;

            calculateOrder();
        }

        function formatRupiah(num) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(num);
        }

        function calculateOrder() {
            const price = parseInt(document.getElementById('inputPrice').value || 0);
            const qty = parseFloat(document.getElementById('inputQty').value || 0);
            const totalMaterialCost = price * qty;
            const totalWeight = qty;

            const distance = parseFloat(document.getElementById('inputDistance').value) || 0;
            
            const armadaCapacity = parseFloat(document.getElementById('selectedArmadaVal').value) || 8;
            const armadaNama = document.getElementById('selectedArmadaNama').value || "Dump Truck";
            const armadaTarif = parseFloat(document.getElementById('selectedArmadaTarif').value) || 0;

            const trips = Math.ceil(totalWeight / armadaCapacity) || 0;
            const shippingCost = distance * armadaTarif * trips;
            
            const totalBeforePPN = totalMaterialCost + shippingCost;
            const ppn = totalBeforePPN * 0.11;
            const grandTotal = totalBeforePPN + ppn;

            // Update UI
            document.getElementById('displayTrips').innerText = trips;
            document.getElementById('resTotalWeight').innerText = totalWeight;
            document.getElementById('resShipping').innerText = formatRupiah(shippingCost);
            document.getElementById('resDistance').innerText = distance.toFixed(1);
            document.getElementById('resPPN').innerText = formatRupiah(ppn);
            document.getElementById('resTotal').innerText = formatRupiah(grandTotal);

            return {
                totalMaterialCost,
                shippingCost,
                ppn,
                grandTotal,
                totalWeight,
                trips,
                armadaNama,
                distance
            };
        }

        function updateInvoice() {
            const data = calculateOrder();
            const section = document.getElementById('invoiceSection');
            section.classList.remove('hidden');

            document.getElementById('invNama').innerText = document.getElementById('inputNama').value || "Pelanggan";
            document.getElementById('invPerusahaan').innerText = document.getElementById('inputPerusahaan').value || "Umum";
            document.getElementById('invAutoAddress').innerText = document.getElementById('autoAddress').value || "";
            document.getElementById('invAlamat').innerText = document.getElementById('inputAlamat').value || "-";

            document.getElementById('invTotalWeight').innerText = data.totalWeight;
            document.getElementById('invTrips').innerText = data.trips;
            document.getElementById('invArmadaName').innerText = data.armadaNama;
            document.getElementById('invShippingCost').innerText = formatRupiah(data.shippingCost);
            document.getElementById('invPPN').innerText = formatRupiah(data.ppn);
            
            document.getElementById('invTotalCost').innerText = formatRupiah(data.grandTotal);
            document.getElementById('invDate').innerText = new Date().toLocaleDateString('id-ID');
            document.getElementById('invId').innerText = "#CIQ-" + Math.floor(Math.random() * 90000 + 10000);

            // Dinamis tabel material
            const tbody = document.getElementById('invTableBody');
            tbody.innerHTML = '';
            
            const productName = document.getElementById('selectedProductName').value;
            const weight = parseFloat(document.getElementById('inputQty').value || 0);
            const price = parseInt(document.getElementById('inputPrice').value || 0);

            if (weight > 0 && productName) {
                tbody.innerHTML += `
                    <tr>
                        <td class="p-4 font-bold text-gray-800">${productName}</td>
                        <td class="p-4 text-center text-gray-600">${weight} Ton</td>
                        <td class="p-4 text-right font-black">${formatRupiah(price * weight)}</td>
                    </tr>`;
            }

            section.scrollIntoView({
                behavior: 'smooth'
            });
        }

        async function sendToWhatsApp() {
            const data = calculateOrder();

            const nama = document.getElementById('inputNama').value || "-";
            const perusahaan = document.getElementById('inputPerusahaan').value || "-";
            const nomorWA = document.getElementById('inputWA').value || "-";
            const alamat = document.getElementById('inputAlamat').value || "-";
            const totalHargaText = document.getElementById('resTotal').innerText;

            const productName = document.getElementById('selectedProductName').value;
            const productPrice = document.getElementById('inputPrice').value;
            const productId = document.getElementById('selectedProductId').value;
            const qty = document.getElementById('inputQty').value;

            if (!productName) {
                alert("Pilih jenis material terlebih dahulu.");
                return;
            }

            if (qty <= 0) {
                alert("Masukkan jumlah (Ton) material yang valid.");
                return;
            }

            if (nama === "-" || nomorWA === "-" || alamat === "-") {
                alert("Harap lengkapi Nama, Nomor WhatsApp, dan Alamat.");
                return;
            }

            // Simpan ke database via AJAX
            try {
                const response = await fetch("{{ route('pemesanan.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        nama_pemesan: nama,
                        instansi: perusahaan,
                        alamat: alamat,
                        wilayah: document.getElementById('autoAddress').value,
                        telp: nomorWA,
                        produk_id: productId,
                        qty: qty,
                        harga_total: data.grandTotal
                    })
                });

                const result = await response.json();
                if (!response.ok) {
                    console.error('Save failed', result);
                    alert("Gagal menyimpan pesanan. Silakan coba lagi.");
                    return;
                }
            } catch (error) {
                console.error("Error saving order:", error);
                alert("Terjadi kesalahan sistem saat menyimpan pesanan.");
                return;
            }

            const text = 
    `*FORM PEMESANAN MATERIAL*\n` +
    `PT CONBLOC INDOTAMA\n` +
    `────────────────────────\n\n` +

    `*DATA PEMESAN*\n` +
    `Nama        : ${nama}\n` +
    `Perusahaan  : ${perusahaan}\n` +
    `WhatsApp    : ${nomorWA}\n\n` +

    `DETAIL PESANAN\n` +
    `• ${productName} (${qty} Ton): ${formatRupiah(data.totalMaterialCost)}\n` +
    `Total Berat : ${data.totalWeight} Ton\n` +
    `Jarak       : ${data.distance.toFixed(1)} KM\n` +
    `Estimasi Unit: ${data.trips} Unit (${data.armadaNama})\n\n` +

    `*LOKASI PENGIRIMAN*\n` +
    `Alamat Detail: ${alamat}\n\n` +

    `*ESTIMASI TAGIHAN*\n` +
    `Total Estimasi : ${formatRupiah(data.grandTotal - data.ppn)}\n` +
    `PPN (11%)      : ${formatRupiah(data.ppn)}\n` +
    `Total Akhir    : ${totalHargaText}\n\n` +
    `────────────────────────\n` +
    `_Mohon konfirmasi jadwal pengiriman dan ketersediaan stok._`;

            // Membuka WhatsApp di tab baru
            const waUrl = `https://wa.me/6281357398265?text=${encodeURIComponent(text)}`;
            window.open(waUrl, '_blank');
        }

        // Custom Dropdown Armada
        function toggleArmadaDropdown() {
            const options = document.getElementById('armadaOptions');
            options.classList.toggle('hidden');
        }

        function selectArmada(armada) {
            document.getElementById('selectedArmadaLabel').innerText = armada.nama;
            document.getElementById('selectedArmadaVal').value = armada.maksimal_ton;
            document.getElementById('selectedArmadaNama').value = armada.nama;
            document.getElementById('selectedArmadaTarif').value = armada.tarif_per_km;
            document.getElementById('armadaOptions').classList.add('hidden');
            calculateOrder();
        }

        // Leaflet Maps Integration
        let map, marker, quarryMarker;
        const quarryCoords = [-7.755892249549022, 112.97445744563642]; // Titik Lokasi Pabrik/Quarry

        function initMap() {
            map = L.map('map').setView(quarryCoords, 11);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            const quarryIcon = L.icon({
                iconUrl: 'https://cdn-icons-png.flaticon.com/512/4320/4320350.png',
                iconSize: [32, 32],
                iconAnchor: [16, 32]
            });

            quarryMarker = L.marker(quarryCoords, {icon: quarryIcon}).addTo(map)
                .bindPopup("<b>Conbloc Indotama Quarry</b><br>Titik Muat Material")
                .openPopup();

            map.on('click', function(e) {
                setDestination(e.latlng);
                reverseGeocode(e.latlng.lat, e.latlng.lng);
                calculateOrder();
            });
        }

        async function reverseGeocode(lat, lng) {
            const autoAddressField = document.getElementById('autoAddress');
            autoAddressField.value = "Mendeteksi wilayah...";
            
            try {
                const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`);
                const data = await response.json();
                
                if (data && data.display_name) {
                    autoAddressField.value = data.display_name;
                } else if (data && data.address) {
                    autoAddressField.value = "Gagal mendeteksi wilayah.";
                }
            } catch (error) {
                console.error("Reverse geocoding error:", error);
                autoAddressField.value = "Gagal menghubungi server alamat.";
            }
        }

        async function searchLocation() {
            const query = document.getElementById('mapSearchInput').value;
            if (!query) return;

            const resultsContainer = document.getElementById('searchResults');
            resultsContainer.classList.add('hidden'); // Close suggestions

            const spinner = document.getElementById('search-spinner');
            spinner.classList.remove('hidden');

            try {
                const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=5&addressdetails=1`);
                const data = await response.json();

                if (data && data.length > 0) {
                    // If multiple results, show them in live search list
                    renderSearchResults(data);
                    // Also center on first one
                    const first = data[0];
                    selectSuggestedLocation(first.lat, first.lon, first.display_name);
                } else {
                    alert("Lokasi tidak ditemukan. Coba masukkan nama daerah yang lebih spesifik.");
                }
            } catch (error) {
                console.error("Search error:", error);
                alert("Terjadi kesalahan saat mencari lokasi.");
            } finally {
                spinner.classList.add('hidden');
            }
        }

        let searchDebounceTimer;
        function onSearchInput(query) {
            clearTimeout(searchDebounceTimer);
            if (!query || query.length < 3) {
                document.getElementById('searchResults').classList.add('hidden');
                return;
            }
            searchDebounceTimer = setTimeout(() => fetchSuggestions(query), 600);
        }

        async function fetchSuggestions(query) {
            try {
                const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=5&addressdetails=1`);
                const data = await response.json();
                renderSearchResults(data);
            } catch (error) {
                console.error("Suggestions fetch error:", error);
            }
        }

        function renderSearchResults(data) {
            const container = document.getElementById('searchResults');
            if (!data || data.length === 0) {
                container.classList.add('hidden');
                return;
            }

            container.innerHTML = data.map(result => `
                <div class="px-4 py-3 hover:bg-primary/10 cursor-pointer border-b last:border-none border-gray-100 transition"
                     onclick="selectSuggestedLocation('${result.lat}', '${result.lon}', '${result.display_name.replace(/'/g, "\\'")}')">
                    <p class="text-xs font-bold text-gray-800 line-clamp-1">${result.display_name}</p>
                    <p class="text-[10px] text-gray-400">Pilih lokasi ini</p>
                </div>
            `).join('');
            
            container.classList.remove('hidden');
        }

        function selectSuggestedLocation(lat, lon, displayName) {
            const latlng = { lat: parseFloat(lat), lng: parseFloat(lon) };
            map.setView(latlng, 15);
            setDestination(latlng);
            
            // Set autoAddress directly from display name or re-reverse geocode for cleaner format
            // Let's re-reverse geocode to keep the "Provinsi: ..." format consistent
            reverseGeocode(lat, lon);
            
            document.getElementById('searchResults').classList.add('hidden');
            document.getElementById('mapSearchInput').value = displayName;
        }
        function setDestination(latlng) {
            if(marker) map.removeLayer(marker);
            marker = L.marker(latlng).addTo(map);
            
            // Hitung Jarak (Earth Radius ~6371km)
            const distance = calculateDistance(quarryCoords[0], quarryCoords[1], latlng.lat, latlng.lng);
            
            document.getElementById('inputDistance').value = distance.toFixed(1);
            document.getElementById('distanceLabel').innerText = `Jarak: ${distance.toFixed(1)} km`;
            
            calculateOrder();
        }

        function getUserLocation() {
            if (!navigator.geolocation) {
                alert("Geolocation tidak didukung oleh browser Anda.");
                return;
            }

            const btn = event.currentTarget;
            const originalText = btn.innerHTML;
            btn.innerHTML = "Mencari Lokasi...";
            btn.disabled = true;

            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const latlng = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    map.setView(latlng, 15);
                    setDestination(latlng);
                    reverseGeocode(latlng.lat, latlng.lng);
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                },
                (error) => {
                    console.error("Error getting location:", error);
                    alert("Gagal mengambil lokasi. Pastikan izin lokasi aktif.");
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }
            );
        }

        function calculateDistance(lat1, lon1, lat2, lon2) {
            const p = 0.017453292519943295; // Math.PI / 180
            const c = Math.cos;
            const a = 0.5 - c((lat2 - lat1) * p)/2 + 
                    c(lat1 * p) * c(lat2 * p) * 
                    (1 - c((lon2 - lon1) * p))/2;
            return 12742 * Math.asin(Math.sqrt(a)); // 2 * R; R = 6371 km
        }

        document.addEventListener('DOMContentLoaded', () => {
            initMap();
            
            // Auto select first product
            const firstProductCard = document.querySelector('.product-card');
            if (firstProductCard) {
                firstProductCard.click();
            }

            @if(count($armadas) > 0)
                selectArmada({!! json_encode($armadas[0]) !!});
            @else
                selectArmada({nama: 'Dump Truck Standard', maksimal_ton: 8, tarif_per_km: 35000});
            @endif

            // Close search results when clicking outside
            document.addEventListener('click', function(e) {
                const searchResults = document.getElementById('searchResults');
                const searchInput = document.getElementById('mapSearchInput');
                if (searchResults && !searchResults.contains(e.target) && e.target !== searchInput) {
                    searchResults.classList.add('hidden');
                }
            });
        });
    </script>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        #armadaOptions {
            scrollbar-width: thin;
            scrollbar-color: #059669 #f3f4f6;
        }

        #armadaOptions::-webkit-scrollbar {
            width: 6px;
        }

        #armadaOptions::-webkit-scrollbar-thumb {
            background-color: #059669;
            border-radius: 20px;
        }

        #armadaDropdownBtn:hover {
            color: #059669;
            transform: translateY(-1px);
        }
    </style>
</body>

</html>