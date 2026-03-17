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
                Pemesanan Material Batu
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

            <div class="lg:col-span-8 space-y-8 no-print">

                <section class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
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

                <section class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold mb-6 flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-primary rounded-full"></span> 2. Detail Material
                    </h3>

                    <div id="materialContainer" class="space-y-4">
                    </div>

                    <button onclick="addMaterialRow()" class="mt-6 w-full py-3 border-2 border-dashed border-primary/30 text-primary font-bold rounded-xl hover:bg-primary/5 transition flex items-center justify-center gap-2">
                        <span>+</span> Tambah Jenis Batu Lain
                    </button>

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
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] uppercase font-bold text-gray-400 text-right">Dibutuhkan</p>
                            <p class="text-3xl font-black text-primary text-right"><span id="displayTrips">0</span> <span class="text-sm font-normal">Unit</span></p>
                        </div>
                    </div>
                </section>

                <section class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold mb-6 flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-primary rounded-full"></span> 3. Lokasi Pengiriman
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase">Nama Proyek</label>
                            <input type="text" id="inputProyek" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl" placeholder="Nama Proyek">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase">Kota / Kabupaten</label>
                            <select id="selectKota" onchange="calculateOrder()" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none">
                                <option value="40">Gresik (40 km)</option>
                                <option value="15">Surabaya (15 km)</option>
                                <option value="60">Sidoarjo (60 km)</option>
                            </select>
                        </div>
                        <textarea id="inputAlamat" class="md:col-span-2 w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl h-24 outline-none" placeholder="Alamat Lengkap Pengiriman..."></textarea>
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
                                <p class="text-gray-400 font-bold mb-1">Tujuan Proyek:</p>
                                <p id="invProyek" class="font-bold text-gray-800 text-sm"></p>
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
                            <p class="text-xs text-gray-500">Biaya Kirim (<span id="invTrips">0</span> Unit): <span id="invShippingCost" class="font-bold text-gray-800"></span></p>
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
        window.onload = () => addMaterialRow();

        function addMaterialRow() {
            const container = document.getElementById('materialContainer');
            const rowId = Date.now();
            const html = `
                <div id="row-${rowId}" class="grid grid-cols-1 md:grid-cols-12 gap-4 p-4 bg-gray-50 rounded-2xl border border-gray-100 relative group animate-fade-in">
                    <div class="md:col-span-4 space-y-2">
                        <label class="text-[10px] font-bold text-gray-400 uppercase">Produk</label>
                        <select onchange="calculateOrder()" class="material-select w-full px-4 py-3 bg-white border border-gray-200 rounded-xl outline-none focus:border-primary">
                            ${materialOptions.map(m => `<option value="${m.name}" data-id="${m.id}">${m.name}</option>`).join('')}
                        </select>
                    </div>
                    <div class="md:col-span-3 space-y-2">
                        <label class="text-[10px] font-bold text-gray-400 uppercase">Harga / Ton (Rp)</label>
                        <input type="number" oninput="calculateOrder()" class="material-price w-full px-4 py-3 bg-white border border-gray-200 rounded-xl outline-none focus:border-primary" placeholder="Masukkan harga...">
                    </div>
                    <div class="md:col-span-4 space-y-2">
                        <label class="text-[10px] font-bold text-gray-400 uppercase">Jumlah (Ton)</label>
                        <input type="number" oninput="calculateOrder()" class="material-qty w-full px-4 py-3 bg-white border border-gray-200 rounded-xl outline-none focus:border-primary" value="0">
                    </div>
                    <div class="md:col-span-1 flex items-end justify-center pb-2">
                        <button onclick="removeRow(${rowId})" class="text-red-400 hover:text-red-600 text-2xl font-bold transition">×</button>
                    </div>
                </div>`;
            container.insertAdjacentHTML('beforeend', html);
        }

        function removeRow(id) {
            const rows = document.querySelectorAll('[id^="row-"]');
            if (rows.length > 1) {
                document.getElementById(`row-${id}`).remove();
                calculateOrder();
            }
        }

        function formatRupiah(num) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(num);
        }

        function calculateOrder() {
            let totalMaterialCost = 0;
            let totalWeight = 0;

            const selects = document.querySelectorAll('.material-select');
            const prices = document.querySelectorAll('.material-price');
            const qtys = document.querySelectorAll('.material-qty');

            selects.forEach((select, i) => {
                const price = parseInt(prices[i].value || 0);
                const qty = parseFloat(qtys[i].value || 0);
                totalMaterialCost += (price * qty);
                totalWeight += qty;
            });

            const distance = parseInt(document.getElementById('selectKota').value);
            
            const armadaCapacity = parseFloat(document.getElementById('selectedArmadaVal').value) || 8;
            const armadaNama = document.getElementById('selectedArmadaNama').value || "Dump Truck";

            const trips = Math.ceil(totalWeight / armadaCapacity) || 0;
            const shippingCost = distance * 5000 * trips;
            
            const totalBeforePPN = totalMaterialCost + shippingCost;
            const ppn = totalBeforePPN * 0.11;
            const grandTotal = totalBeforePPN + ppn;

            // Update UI
            document.getElementById('displayTrips').innerText = trips;
            document.getElementById('resTotalWeight').innerText = totalWeight;
            document.getElementById('resShipping').innerText = formatRupiah(shippingCost);
            document.getElementById('resPPN').innerText = formatRupiah(ppn);
            document.getElementById('resTotal').innerText = formatRupiah(grandTotal);

            return {
                totalMaterialCost,
                shippingCost,
                ppn,
                grandTotal,
                totalWeight,
                trips,
                armadaNama
            };
        }

        function updateInvoice() {
            const data = calculateOrder();
            const section = document.getElementById('invoiceSection');
            section.classList.remove('hidden');

            document.getElementById('invNama').innerText = document.getElementById('inputNama').value || "Pelanggan";
            document.getElementById('invPerusahaan').innerText = document.getElementById('inputPerusahaan').value || "Umum";
            document.getElementById('invProyek').innerText = document.getElementById('inputProyek').value || "-";
            document.getElementById('invAlamat').innerText = document.getElementById('inputAlamat').value || "-";

            document.getElementById('invTotalWeight').innerText = data.totalWeight;
            document.getElementById('invTrips').innerText = data.trips;
            document.getElementById('invShippingCost').innerText = formatRupiah(data.shippingCost);
            document.getElementById('invPPN').innerText = formatRupiah(data.ppn);
            
            // Tambahkan info armada di invoice (opsional, tapi bagus untuk verifikasi)
            document.getElementById('invTrips').parentElement.innerHTML = `Biaya Kirim (${data.trips} Unit ${data.armadaNama}): <span id="invShippingCost" class="font-bold text-gray-800">${formatRupiah(data.shippingCost)}</span>`;

            document.getElementById('invTotalCost').innerText = formatRupiah(data.grandTotal);
            document.getElementById('invDate').innerText = new Date().toLocaleDateString('id-ID');
            document.getElementById('invId').innerText = "#CIQ-" + Math.floor(Math.random() * 90000 + 10000);

            // Dinamis tabel material
            const tbody = document.getElementById('invTableBody');
            tbody.innerHTML = '';
            const selects = document.querySelectorAll('.material-select');
            const prices = document.querySelectorAll('.material-price');
            const qtys = document.querySelectorAll('.material-qty');

            selects.forEach((s, i) => {
                const q = parseFloat(qtys[i].value || 0);
                if (q > 0) {
                    const p = parseInt(prices[i].value || 0);
                    tbody.innerHTML += `
                        <tr>
                            <td class="p-4 font-bold text-gray-800">${s.value}</td>
                            <td class="p-4 text-center text-gray-600">${q} Ton</td>
                            <td class="p-4 text-right font-black">${formatRupiah(p * q)}</td>
                        </tr>`;
                }
            });

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
            const proyek = document.getElementById('inputProyek').value || "-";
            const totalHargaText = document.getElementById('resTotal').innerText;

            let detailProduk = "";
            let items = [];
            const selects = document.querySelectorAll('.material-select');
            const prices = document.querySelectorAll('.material-price');
            const qtys = document.querySelectorAll('.material-qty');

            selects.forEach((s, i) => {
                const q = parseFloat(qtys[i].value || 0);
                if (q > 0) {
                    const price = parseInt(prices[i].value || 0);
                    detailProduk += `   - ${s.value}: ${q} Ton (@${formatRupiah(price)})\n`;
                    items.push({
                        produk_id: s.options[s.selectedIndex].dataset.id,
                        qty: q,
                        harga_total: (price * q)
                    });
                }
            });

            if (items.length === 0) {
                alert("Harap pilih minimal satu produk dan masukkan jumlahnya.");
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
                        telp: nomorWA,
                        items: items
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
    `${detailProduk}` +
    `Total Berat : ${data.totalWeight} Ton\n` +
    `Estimasi Unit: ${data.trips} Unit (${data.armadaNama})\n\n` +

    `*LOKASI PENGIRIMAN*\n` +
    `Nama Proyek : ${proyek}\n` +
    `Alamat      : ${alamat}\n\n` +

    `*ESTIMASI TAGIHAN*\n` +
    `Total Estimasi : ${formatRupiah(data.grandTotal - data.ppn)}\n` +
    `PPN (11%)      : ${formatRupiah(data.ppn)}\n` +
    `Total Akhir    : ${totalHargaText}\n\n` +

    `────────────────────────\n` +
    `*PEMBAYARAN TRANSFER*\n\n` +

    `Bank BCA\n` +
    `No Rekening : 1234567890\n` +
    `Atas Nama   : PT Conbloc Indotama\n\n` +

    `Bank Mandiri\n` +
    `No Rekening : 9876543210\n` +
    `Atas Nama   : PT Conbloc Indotama\n\n` +

    `────────────────────────\n` +
    `*CATATAN*\n` +
    `• Harga dapat berubah sesuai jarak pengiriman\n` +
    `• Pengiriman dilakukan setelah pembayaran dikonfirmasi\n` +
    `• Mohon kirim bukti transfer ke admin\n\n` +

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
            document.getElementById('selectedArmadaLabel').innerText = `${armada.nama} (${armada.maksimal_ton}T)`;
            document.getElementById('selectedArmadaVal').value = armada.maksimal_ton;
            document.getElementById('selectedArmadaNama').value = armada.nama;
            document.getElementById('armadaOptions').classList.add('hidden');
            calculateOrder();
        }

        // Close dropdown when click outside
        window.addEventListener('click', function(e) {
            const dropdown = document.getElementById('armadaOptions');
            const btn = document.getElementById('armadaDropdownBtn');
            if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });

        // Set default armada pada load
        document.addEventListener('DOMContentLoaded', () => {
            @if(count($armadas) > 0)
                selectArmada({!! json_encode($armadas[0]) !!});
            @else
                selectArmada({nama: 'Dump Truck Standard', maksimal_ton: 8});
            @endif
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