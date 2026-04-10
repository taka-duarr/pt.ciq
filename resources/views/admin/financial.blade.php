<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laporan Keuangan - Batu Split</title>
    <style>
        :root { --primary: #B22222; } /* Dark Red as per image */
        .bg-primary { background-color: var(--primary); }
        .text-primary { color: var(--primary); }
        .border-primary { border-color: var(--primary); }
        
        table {
            border-collapse: collapse;
            width: 100%;
            font-family: Arial, sans-serif;
        }
        th {
            background-color: #C00000;
            color: white;
            padding: 8px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 11px;
            font-weight: bold;
        }
        td {
            border: 1px solid #ddd;
            padding: 6px 10px;
            font-size: 12px;
        }
        .header-main {
            background-color: #C00000;
            color: white;
            text-align: center;
            font-weight: bold;
        }
        .bg-green-highlight { background-color: #C6EFCE; color: #006100; font-weight: bold; }
        .bg-yellow-summary { background-color: #FFFF00; font-weight: bold; }
        
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .edit-input {
            width: 100%;
            border: none;
            background: transparent;
            text-align: right;
            outline: none;
        }
        .edit-input:focus {
            background: #fff;
            box-shadow: 0 0 0 2px rgba(192, 0, 0, 0.2);
        }
        .bg-editable { 
            background-color: #f0f9ff !important; /* Light blue for inputs */
        }
        .bg-calculated {
            background-color: #ffffff !important;
        }
        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: bold;
        }
        .legend-box {
            width: 16px;
            height: 16px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen text-gray-700">

    @include('admin.sidebar')

    <div id="mainContent" class="ml-64 p-8 flex-1 transition-all duration-300">
        
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-red-700">Laporan Keuangan Stone Crusher</h2>
                <div class="flex gap-4 mt-2">
                    <div class="legend-item text-blue-700">
                        <div class="legend-box bg-blue-50 border-blue-200"></div>
                        <span>Kolom Input Data</span>
                    </div>
                    <div class="legend-item text-gray-500">
                        <div class="legend-box bg-white border-gray-200"></div>
                        <span>Kolom Rumus Automatis</span>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                    <form action="{{ route('admin.financial.index') }}" method="GET" class="flex items-center gap-3">
                        <select name="year_id" onchange="this.form.submit()" 
                            class="bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
                            @foreach($years as $year)
                                <option value="{{ $year->id }}" {{ $selectedYear && $selectedYear->id == $year->id ? 'selected' : '' }}>
                                    Tahun {{ $year->year }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                    
                    @if($selectedYear)
                    <a href="{{ route('admin.financial.exportExcel', $selectedYear->id) }}" 
                        class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2.5 rounded-lg font-semibold transition shadow-lg shadow-green-600/20 whitespace-nowrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Cetak Excel
                    </a>
                    @endif

                @if($selectedYear)
                <div class="flex items-center gap-2">
                    <button onclick="openEditYearModal('{{ $selectedYear->id }}', '{{ $selectedYear->year }}')" class="bg-gray-200 text-gray-700 px-3 py-2 rounded-lg text-sm font-medium hover:bg-gray-300 transition" title="Edit Tahun">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                    </button>
                    <form action="{{ route('admin.financial.destroyYear', $selectedYear->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data tahun {{ $selectedYear->year }}? Semua data bulanan di tahun ini akan hilang.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-50 text-red-600 border border-red-200 px-3 py-2 rounded-lg text-sm font-medium hover:bg-red-100 transition" title="Hapus Tahun">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </button>
                    </form>
                </div>
                @endif

                <button onclick="openAddYearModal()" class="bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-opacity-90 transition">
                    + Tambah Laporan
                </button>
            </div>
        </div>

        @if($selectedYear)
        <!-- SUMMARY CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-blue-500">
                <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Total Benefit Crusher</p>
                <h3 class="text-2xl font-black text-gray-800 mt-1" id="card-crusher">Rp {{ number_format($totals['crusher_revenue'], 0, ',', '.') }}</h3>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-purple-500">
                <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Total Benefit Sewa</p>
                <h3 class="text-2xl font-black text-gray-800 mt-1" id="card-sewa">Rp {{ number_format($totals['sewa_revenue'], 0, ',', '.') }}</h3>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-green-500">
                <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Grand Total Pendapatan</p>
                <h3 class="text-2xl font-black text-green-600 mt-1" id="card-total">Rp {{ number_format($totals['total_revenue'], 0, ',', '.') }}</h3>
            </div>
        </div>
        <!-- STONE CRUSHER TABLE -->
        <div class="bg-white shadow-xl overflow-x-auto rounded-lg mb-10">
            <div class="bg-red-800 text-white px-4 py-2 text-sm font-bold uppercase tracking-wider">
                Laporan Stone Crusher
            </div>
            <table>
                <thead>
                    <tr>
                        <th rowspan="2" class="w-16">BULAN</th>
                        <th colspan="9" class="header-main">STONE CRUSHER</th>
                    </tr>
                    <tr>
                        <th class="w-24">HARGA (TON)</th>
                        <th class="w-28">PRODUKSI CRUSHER (TON)</th>
                        <th class="w-28">PENDAPATAN SEWA CRUSHER</th>
                        <th class="w-28">PRODUKSI CRUSHER (TON)/PPN</th>
                        <th class="w-28">TOTAL CRUSHER (15.000)/PPN</th>
                        <th class="w-20">PPN 11%</th>
                        <th class="w-20">PPH 2%</th>
                        <th class="w-28 bg-green-700/80">TOTAL CRUSHER</th>
                        <th class="w-28">BENEFIT CRUSHER</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php
                        $grandTotalCrusher = [
                            'produksi' => 0, 'sewa' => 0, 'prod_ppn' => 0, 'total_ppn' => 0,
                            'ppn' => 0, 'pph' => 0, 'total_akhir' => 0, 'benefit' => 0
                        ];
                    @endphp
                    @foreach($monthlySales as $sale)
                    <tr data-sale-id="{{ $sale->id }}" class="crusher-row">
                        <td class="text-center bg-red-700 text-white font-bold text-[10px]">{{ $sale->month_name }}-{{ substr($selectedYear->year, 2) }}</td>
                        <td class="bg-editable"><input type="number" step="any" value="{{ $sale->crusher_price + 0 }}" class="edit-input font-medium" name="crusher_price"></td>
                        <td class="bg-editable"><input type="number" step="any" value="{{ $sale->crusher_production + 0 }}" class="edit-input font-medium" name="crusher_production"></td>
                        <td class="text-right font-bold bg-calculated" id="sewa-{{ $sale->id }}">{{ number_format($sale->pendapatan_sewa, 0, ',', '.') }}</td>
                        <td class="bg-editable"><input type="number" step="any" value="{{ $sale->produksi_ppn + 0 }}" class="edit-input font-medium" name="produksi_ppn"></td>
                        <td class="text-right bg-calculated" id="totalppn-{{ $sale->id }}">{{ number_format($sale->total_crusher_ppn, 0, ',', '.') }}</td>
                        <td class="text-right bg-calculated" id="ppn-{{ $sale->id }}">{{ number_format($sale->ppn_11, 0, ',', '.') }}</td>
                        <td class="text-right bg-calculated" id="pph-{{ $sale->id }}">{{ number_format($sale->pph_2, 0, ',', '.') }}</td>
                        <td class="text-right bg-green-highlight" id="totalakhir-{{ $sale->id }}">{{ number_format($sale->total_crusher_akhir, 0, ',', '.') }}</td>
                        <td class="text-right font-bold bg-calculated" id="benefit-{{ $sale->id }}">{{ number_format($sale->benefit_crusher, 0, ',', '.') }}</td>
                    </tr>
                    @php
                        $grandTotalCrusher['produksi'] += $sale->crusher_production;
                        $grandTotalCrusher['sewa'] += $sale->pendapatan_sewa;
                        $grandTotalCrusher['prod_ppn'] += $sale->produksi_ppn;
                        $grandTotalCrusher['total_ppn'] += $sale->total_crusher_ppn;
                        $grandTotalCrusher['ppn'] += $sale->ppn_11;
                        $grandTotalCrusher['pph'] += $sale->pph_2;
                        $grandTotalCrusher['total_akhir'] += $sale->total_crusher_akhir;
                        $grandTotalCrusher['benefit'] += $sale->benefit_crusher;
                    @endphp
                    @endforeach
                </tbody>
                <tfoot class="bg-yellow-summary">
                    <tr class="text-right font-bold">
                        <td class="text-center bg-yellow-summary">TOTAL</td>
                        <td></td>
                        <td id="foot-crusher-prod">{{ number_format($grandTotalCrusher['produksi'], 0, ',', '.') }}</td>
                        <td id="foot-crusher-sewa">{{ number_format($grandTotalCrusher['sewa'], 0, ',', '.') }}</td>
                        <td id="foot-crusher-prodppn">{{ number_format($grandTotalCrusher['prod_ppn'], 0, ',', '.') }}</td>
                        <td id="foot-crusher-totalppn">{{ number_format($grandTotalCrusher['total_ppn'], 0, ',', '.') }}</td>
                        <td id="foot-crusher-ppn">{{ number_format($grandTotalCrusher['ppn'], 0, ',', '.') }}</td>
                        <td id="foot-crusher-pph">{{ number_format($grandTotalCrusher['pph'], 0, ',', '.') }}</td>
                        <td id="foot-crusher-totalakhir" class="bg-green-700/80 text-white">{{ number_format($grandTotalCrusher['total_akhir'], 0, ',', '.') }}</td>
                        <td id="foot-crusher-benefit">{{ number_format($grandTotalCrusher['benefit'], 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- SEWA TABLE -->
        <div class="bg-white shadow-xl overflow-x-auto rounded-lg">
            <div class="bg-red-800 text-white px-4 py-2 text-sm font-bold uppercase tracking-wider">
                Laporan Sewa
            </div>
            <table>
                <thead>
                    <tr>
                        <th rowspan="2" class="w-16">BULAN</th>
                        <th colspan="7" class="header-main">SEWA</th>
                    </tr>
                    <tr>
                        <th class="w-24">LOADER</th>
                        <th class="w-24">DUMP TRUCK</th>
                        <th class="w-24">SANY</th>
                        <th class="w-28">HYUNDAY PC 220</th>
                        <th class="w-28">HYUNDAY PC 330</th>
                        <th class="w-28">PEMAKAIAN SPARE PART</th>
                        <th class="w-28 bg-red-900/50">BENEFIT SEWA</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php
                        $grandTotalSewa = [
                            'loader' => 0, 'truck' => 0, 'sany' => 0, 'h220' => 0, 'h330' => 0, 'spare' => 0, 'benefit' => 0
                        ];
                    @endphp
                    @foreach($monthlySales as $sale)
                    <tr data-sale-id="{{ $sale->id }}" class="sewa-row">
                        <td class="text-center bg-red-700 text-white font-bold text-[10px]">{{ $sale->month_name }}-{{ substr($selectedYear->year, 2) }}</td>
                        <td class="bg-editable"><input type="number" step="any" value="{{ $sale->sewa_loader + 0 }}" class="edit-input font-medium" name="sewa_loader"></td>
                        <td class="bg-editable"><input type="number" step="any" value="{{ $sale->sewa_dump_truck + 0 }}" class="edit-input font-medium" name="sewa_dump_truck"></td>
                        <td class="bg-editable"><input type="number" step="any" value="{{ $sale->sewa_sany + 0 }}" class="edit-input font-medium" name="sewa_sany"></td>
                        <td class="bg-editable"><input type="number" step="any" value="{{ $sale->sewa_hyundai_220 + 0 }}" class="edit-input font-medium" name="sewa_hyundai_220"></td>
                        <td class="bg-editable"><input type="number" step="any" value="{{ $sale->sewa_hyundai_330 + 0 }}" class="edit-input font-medium" name="sewa_hyundai_330"></td>
                        <td class="bg-editable"><input type="number" step="any" value="{{ $sale->spare_part + 0 }}" class="edit-input font-medium shadow-inner" name="spare_part"></td>
                        <td class="text-right font-bold bg-green-highlight" id="sewa-benefit-{{ $sale->id }}">{{ number_format($sale->benefit_sewa, 0, ',', '.') }}</td>
                    </tr>
                    @php
                        $grandTotalSewa['loader'] += $sale->sewa_loader;
                        $grandTotalSewa['truck'] += $sale->sewa_dump_truck;
                        $grandTotalSewa['sany'] += $sale->sewa_sany;
                        $grandTotalSewa['h220'] += $sale->sewa_hyundai_220;
                        $grandTotalSewa['h330'] += $sale->sewa_hyundai_330;
                        $grandTotalSewa['spare'] += $sale->spare_part;
                        $grandTotalSewa['benefit'] += $sale->benefit_sewa;
                    @endphp
                    @endforeach
                </tbody>
                <tfoot class="bg-yellow-summary">
                    <tr class="text-right font-bold">
                        <td class="text-center bg-yellow-summary">TOTAL</td>
                        <td id="foot-sewa-loader">{{ number_format($grandTotalSewa['loader'], 0, ',', '.') }}</td>
                        <td id="foot-sewa-dt">{{ number_format($grandTotalSewa['truck'], 0, ',', '.') }}</td>
                        <td id="foot-sewa-sany">{{ number_format($grandTotalSewa['sany'], 0, ',', '.') }}</td>
                        <td id="foot-sewa-h220">{{ number_format($grandTotalSewa['h220'], 0, ',', '.') }}</td>
                        <td id="foot-sewa-h330">{{ number_format($grandTotalSewa['h330'], 0, ',', '.') }}</td>
                        <td id="foot-sewa-spare">{{ number_format($grandTotalSewa['spare'], 0, ',', '.') }}</td>
                        <td id="foot-sewa-benefit" class="bg-green-700/80 text-white">{{ number_format($grandTotalSewa['benefit'], 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- TOTAL REVENUE SUMMARY TABLE -->
        <div class="flex justify-center mb-10 pt-8">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden w-64 border-2 border-gray-200">
                <table class="!w-full">
                    <thead>
                        <tr>
                            <th colspan="2" class="!bg-[#C00000] text-white font-bold py-4 text-xs tracking-widest uppercase border-none">
                                TOTAL PENDAPATAN
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($monthlySales as $sale)
                        <tr data-sale-id="{{ $sale->id }}" class="total-row text-xs">
                            <td class="px-4 py-2 font-bold text-red-800 uppercase italic">
                                {{ $sale->month_name }}
                            </td>
                            <td class="text-right px-4 py-2 font-black text-gray-800 italic" id="summary-total-{{ $sale->id }}">
                                {{ number_format($sale->total_revenue, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" class="!bg-[#002060] text-white text-right px-6 py-3 text-lg font-black border-none" id="foot-summary-total">
                                {{ number_format($totals['total_revenue'], 0, ',', '.') }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        @else
        <div class="bg-white p-12 text-center rounded-xl shadow-sm border border-dashed border-gray-300">
            <h3 class="text-lg font-medium text-gray-900">Belum ada data laporan</h3>
            <p class="mt-1 text-sm text-gray-500">Klik "Tambah Laporan" untuk memulai.</p>
        </div>
        @endif
    </div>

    <!-- Modal Edit Year -->
    <div id="editYearModal" class="hidden fixed inset-0 bg-black/50 z-[9999] flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-sm border-t-4 border-blue-600">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Ubah Tahun Laporan</h3>
            <form id="editYearForm" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-600 mb-2">Tahun</label>
                    <input type="number" name="year" id="edit_year_input" value="" required 
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-600/50 text-center text-lg font-bold">
                </div>
                <div class="flex gap-3">
                    <button type="button" onclick="closeEditYearModal()" class="flex-1 bg-gray-100 text-gray-600 font-semibold py-3 rounded-xl hover:bg-gray-200 transition">Batal</button>
                    <button type="submit" class="flex-1 bg-blue-600 text-white font-semibold py-3 rounded-xl hover:bg-opacity-90 transition shadow-lg shadow-blue-600/20">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Add Year -->
    <div id="addYearModal" class="hidden fixed inset-0 bg-black/50 z-[9999] flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-sm border-t-4 border-red-700">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Tambah Tahun Laporan</h3>
            <form action="{{ route('admin.financial.storeYear') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-600 mb-2">Pilih Tahun</label>
                    <input type="number" name="year" value="{{ date('Y') }}" required 
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-600/50 text-center text-lg font-bold">
                </div>
                <div class="flex gap-3">
                    <button type="button" onclick="closeAddYearModal()" class="flex-1 bg-gray-100 text-gray-600 font-semibold py-3 rounded-xl hover:bg-gray-200 transition">Batal</button>
                    <button type="submit" class="flex-1 bg-red-700 text-white font-semibold py-3 rounded-xl hover:bg-opacity-90 transition shadow-lg shadow-red-700/20">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openAddYearModal() { document.getElementById('addYearModal').classList.remove('hidden'); }
        function closeAddYearModal() { document.getElementById('addYearModal').classList.add('hidden'); }

        function openEditYearModal(id, year) {
            const modal = document.getElementById('editYearModal');
            const form = document.getElementById('editYearForm');
            const input = document.getElementById('edit_year_input');
            
            form.action = `/admin/financial/year/${id}`;
            input.value = year;
            modal.classList.remove('hidden');
        }
        function closeEditYearModal() {
            document.getElementById('editYearModal').classList.add('hidden');
        }

        document.querySelectorAll('.edit-input').forEach(input => {
            input.addEventListener('change', async function() {
                const row = this.closest('tr');
                const saleId = row.dataset.saleId;
                
                const formData = new FormData();
                row.querySelectorAll('.edit-input').forEach(el => {
                    formData.append(el.name, el.value);
                });
                formData.append('mining_price', 0); // Keep for backend validation
                formData.append('mining_production', 0);
                formData.append('_method', 'PATCH');

                row.style.opacity = '0.5';

                try {
                    const response = await fetch(`/admin/financial/monthly/${saleId}`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        if (row.classList.contains('crusher-row')) {
                            const price = parseFloat(row.querySelector('[name="crusher_price"]').value) || 0;
                            const production = parseFloat(row.querySelector('[name="crusher_production"]').value) || 0;
                            const prodPpn = parseFloat(row.querySelector('[name="produksi_ppn"]').value) || 0;
                            calculateCrusherRow(row, price, production, prodPpn);
                        } else if (row.classList.contains('sewa-row')) {
                            calculateSewaRow(row);
                        }
                        updateTableTotals();
                    }
                } catch (error) {
                    console.error('Save failed:', error);
                } finally {
                    row.style.opacity = '1';
                }
            });
        });

        function calculateCrusherRow(row, price, prod, prodPpn) {
            const saleId = row.dataset.saleId;
            const sewa = price * prod;
            const totalPpn = prodPpn * price;
            const ppn11 = totalPpn * 0.11;
            const pph2 = totalPpn * 0.02;
            const totalAkhir = totalPpn + ppn11 - pph2;
            const benefit = sewa + totalAkhir;

            document.getElementById(`sewa-${saleId}`).textContent = formatIDR(sewa);
            // document.getElementById(`prodppn-${saleId}`).textContent = formatNum(prodPpn, 2); // Now an input
            document.getElementById(`totalppn-${saleId}`).textContent = formatIDR(totalPpn);
            document.getElementById(`ppn-${saleId}`).textContent = formatIDR(ppn11);
            document.getElementById(`pph-${saleId}`).textContent = formatIDR(pph2);
            document.getElementById(`totalakhir-${saleId}`).textContent = formatIDR(totalAkhir);
            document.getElementById(`benefit-${saleId}`).textContent = formatIDR(benefit);

            syncTotalRow(saleId);
        }

        function calculateSewaRow(row) {
            const saleId = row.dataset.saleId;
            let benefit = 0;
            row.querySelectorAll('.edit-input').forEach(el => {
                // Only sum up sewa-related inputs for sewa benefit
                if (el.name.startsWith('sewa_') || el.name === 'spare_part') {
                    benefit += (parseFloat(el.value) || 0);
                }
            });
            document.getElementById(`sewa-benefit-${saleId}`).textContent = formatIDR(benefit);
            
            syncTotalRow(saleId);
        }

        function syncTotalRow(saleId) {
            const crusherBenefit = parseIDR(document.getElementById(`benefit-${saleId}`).textContent);
            const sewaBenefit = parseIDR(document.getElementById(`sewa-benefit-${saleId}`).textContent);
            document.getElementById(`summary-total-${saleId}`).textContent = formatIDR(crusherBenefit + sewaBenefit);
        }

        function updateTableTotals() {
            // Update Crusher Totals
            let cTotals = { prod: 0, sewa: 0, prodppn: 0, tppn: 0, ppn: 0, pph: 0, takhir: 0, benefit: 0 };
            document.querySelectorAll('.crusher-row').forEach(row => {
                const p = parseFloat(row.querySelector('[name="crusher_price"]').value) || 0;
                const q = parseFloat(row.querySelector('[name="crusher_production"]').value) || 0;
                const qPpn = parseFloat(row.querySelector('[name="produksi_ppn"]').value) || 0;
                cTotals.prod += q;
                cTotals.sewa += (p * q);
                cTotals.prodppn += qPpn;
                cTotals.tppn += (qPpn * p);
                cTotals.ppn += ((qPpn * p) * 0.11);
                cTotals.pph += ((qPpn * p) * 0.02);
            });
            cTotals.takhir = cTotals.tppn + cTotals.ppn - cTotals.pph;
            cTotals.benefit = cTotals.sewa + cTotals.takhir;

            document.getElementById('foot-crusher-prod').textContent = formatNum(cTotals.prod, 3);
            document.getElementById('foot-crusher-sewa').textContent = formatIDR(cTotals.sewa);
            document.getElementById('foot-crusher-prodppn').textContent = formatNum(cTotals.prodppn, 3);
            document.getElementById('foot-crusher-totalppn').textContent = formatIDR(cTotals.tppn);
            document.getElementById('foot-crusher-ppn').textContent = formatIDR(cTotals.ppn);
            document.getElementById('foot-crusher-pph').textContent = formatIDR(cTotals.pph);
            document.getElementById('foot-crusher-totalakhir').textContent = formatIDR(cTotals.takhir);
            document.getElementById('foot-crusher-benefit').textContent = formatIDR(cTotals.benefit);

            // Update Sewa Totals
            let sTotals = { loader: 0, truck: 0, sany: 0, h220: 0, h330: 0, spare: 0, benefit: 0 };
            document.querySelectorAll('.sewa-row').forEach(row => {
                sTotals.loader += (parseFloat(row.querySelector('[name="sewa_loader"]').value) || 0);
                sTotals.truck += (parseFloat(row.querySelector('[name="sewa_dump_truck"]').value) || 0);
                sTotals.sany += (parseFloat(row.querySelector('[name="sewa_sany"]').value) || 0);
                sTotals.h220 += (parseFloat(row.querySelector('[name="sewa_hyundai_220"]').value) || 0);
                sTotals.h330 += (parseFloat(row.querySelector('[name="sewa_hyundai_330"]').value) || 0);
                sTotals.spare += (parseFloat(row.querySelector('[name="spare_part"]').value) || 0);
            });
            sTotals.benefit = sTotals.loader + sTotals.truck + sTotals.sany + sTotals.h220 + sTotals.h330 + sTotals.spare;

            document.getElementById('foot-sewa-loader').textContent = formatIDR(sTotals.loader);
            document.getElementById('foot-sewa-truck').textContent = formatIDR(sTotals.truck);
            document.getElementById('foot-sewa-sany').textContent = formatIDR(sTotals.sany);
            document.getElementById('foot-sewa-h220').textContent = formatIDR(sTotals.h220);
            document.getElementById('foot-sewa-h330').textContent = formatIDR(sTotals.h330);
            document.getElementById('foot-sewa-spare').textContent = formatIDR(sTotals.spare);
            document.getElementById('foot-sewa-benefit').textContent = formatIDR(sTotals.benefit);

            // Update Global Summary
            const grandTotal = cTotals.benefit + sTotals.benefit;
            if(document.getElementById('foot-summary-total')) {
                document.getElementById('foot-summary-total').textContent = formatIDR(grandTotal);
            }

            // Sync individual summary rows on load
            document.querySelectorAll('.total-row').forEach(row => {
                const sid = row.dataset.saleId;
                const cb = parseIDR(document.getElementById(`benefit-${sid}`).textContent);
                const sb = parseIDR(document.getElementById(`sewa-benefit-${sid}`).textContent);
                document.getElementById(`summary-total-${sid}`).textContent = formatIDR(cb + sb);
            });

            if(document.getElementById('card-crusher')) {
                document.getElementById('card-crusher').textContent = 'Rp ' + formatIDR(cTotals.benefit);
                document.getElementById('card-sewa').textContent = 'Rp ' + formatIDR(sTotals.benefit);
                document.getElementById('card-total').textContent = 'Rp ' + formatIDR(grandTotal);
            }
        }

        // JS Format Helpers - Rounded to 0 decimal places to match Excel
        function formatIDR(num) {
            return new Intl.NumberFormat('id-ID', { maximumFractionDigits: 0 }).format(Math.round(num));
        }
        function parseIDR(str) {
            return parseFloat(str.replace(/\./g, '').replace(',', '.').replace('Rp ', '')) || 0;
        }
        function formatNum(num, dec) {
            return new Intl.NumberFormat('id-ID', { maximumFractionDigits: 0 }).format(Math.round(num));
        }

        // Initial calc
        window.addEventListener('load', () => { updateTableTotals(); });
    </script>
</body>
</html>
