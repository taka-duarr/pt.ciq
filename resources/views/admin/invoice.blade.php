<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media print {
            body { background: white; }
            .no-print { display: none; }
            .print-shadow-none { shadow: none !important; }
        }
        @page { size: A4; margin: 0; }
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-200 p-0 md:p-8">

    <div id="invoice-card" class="max-w-[800px] mx-auto bg-white p-12 shadow-2xl min-h-[1050px] relative">
        
        <div class="flex justify-between items-start mb-12">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <img src="{{ asset('img/logo1.png') }}" class="h-8 w-auto" id="logo-full">
                </div>
            </div>
            <div class="text-right">
                <h2 class="text-5xl font-black text-gray-800 tracking-tighter mb-1">STRUK</h2>
                <p class="text-sm font-bold text-gray-600 uppercase">Tanggal. 03.20.2026</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-8 mb-12 bg-gray-50 p-6 rounded-sm border border-gray-100">
            <div>
                <h3 class="font-black text-xs uppercase mb-3 tracking-widest text-gray-400">Tagihan Untuk</h3>
                <p class="font-bold text-gray-800 mb-1" id="inv-nama">Andi Saputra</p>
                <p class="text-sm text-gray-600 leading-relaxed" id="inv-alamat">PT Sumber Jaya<br>Gresik, Jawa Timur</p>
                <p class="text-sm font-bold text-gray-800 mt-2" id="inv-telp">0812-3456-7890</p>
            </div>
            <div>
                <h3 class="font-black text-xs uppercase mb-3 tracking-widest text-gray-400">Tujuan Pengiriman</h3>
                <p class="font-bold text-gray-400 mb-1 uppercase text-[10px]">Alamat Kantor</p>
                <p class="text-sm text-gray-600 leading-relaxed">Gresik, Jawa Timur<br>Indonesia</p>
                <p class="text-sm font-bold text-gray-800 mt-2">0812-3456-7890</p>
            </div>
        </div>

        <div class="flex justify-between border-b-2 border-black pb-2 mb-4">
            <p class="text-xs font-bold uppercase tracking-widest">Tanggal: <span id="current-date">03 Maret 2026</span></p>
            <p class="text-xs font-bold uppercase tracking-widest">No. Struk: <span id="inv-id">BTOIUQGW21</span></p>
        </div>

        <table class="w-full text-left mb-8">
            <thead>
                <tr class="text-[10px] uppercase font-black text-gray-400 border-b">
                    <th class="py-3 w-12">No</th>
                    <th class="py-3">Deskripsi Produk</th>
                    <th class="py-3 text-right">Harga Satuan</th>
                    <th class="py-3 text-center">Jumlah (Qty)</th>
                    <th class="py-3 text-right">Total</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                <tr>
                    <td class="py-4 font-bold text-gray-400">1.</td>
                    <td class="py-4">
                        <p class="font-bold text-gray-800" id="inv-produk">Batu Pecah 5-10 mm</p>
                        <p class="text-xs text-gray-400 italic">Bahan bangunan berkualitas tinggi</p>
                    </td>
                    <td class="py-4 text-right font-medium">Rp 150.000</td>
                    <td class="py-4 text-center font-bold" id="inv-qty">12 Ton</td>
                    <td class="py-4 text-right font-black" id="inv-total">Rp 1.800.000</td>
                </tr>
            </tbody>
        </table>

        <div class="grid grid-cols-2 gap-12 pt-4 border-t border-gray-100">
            <div>
                <div class="bg-gray-50 p-6 rounded-sm">
                    <h3 class="text-2xl font-black text-gray-800 mb-2 tracking-tighter" id="grand-total">Rp 1.800.000</h3>
                    <p class="text-[10px] uppercase font-bold text-gray-400 mb-4 tracking-widest">Total Tagihan</p>
                    
                    <div class="space-y-4">
                        <div>
                            <p class="text-[10px] uppercase font-black text-gray-800 tracking-widest">Info Pembayaran:</p>
                            <p class="text-xs text-gray-500">Bank Mandiri: 123-456-7890<br>A/N: Firman Ardiansyah</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-3">
                <div class="flex justify-between text-sm uppercase font-bold text-gray-400">
                    <span>Subtotal:</span>
                    <span class="text-gray-800" id="subtotal">Rp 1.800.000</span>
                </div>
                <div class="flex justify-between text-sm uppercase font-bold text-gray-400">
                    <span>Pajak (0%):</span>
                    <span class="text-gray-800">0</span>
                </div>
                <div class="flex justify-between text-lg uppercase font-black text-gray-800 pt-4 border-t">
                    <span>Total Keseluruhan:</span>
                    <span id="grand-total-2">Rp 1.800.000</span>
                </div>
            </div>
        </div>

        <div class="absolute bottom-12 left-12 right-12 flex justify-between items-center text-[10px] text-gray-400 uppercase tracking-widest border-t pt-4">
            <p>Jl. Contoh No. 123, Surabaya, Jawa Timur • websiteanda.com</p>
            <div class="flex gap-4">
                <span>0812-3456-7890</span>
            </div>
        </div>
    </div>
</body>
<script>
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('mode') === 'autoprint') {
            setTimeout(() => {
                window.print();
                window.onafterprint = function() {
                    window.close();
                };
            }, 500);
        }
    }
</script>
</html>