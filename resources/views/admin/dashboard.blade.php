<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Dashboard Admin - Batu Split</title>

    <style>
        :root { --primary: #005f37; }
        iframe { border: none; }
    </style>
</head>

<body class="bg-gray-50 min-h-screen text-gray-700">

    <!-- SIDEBAR (HARUS ADA ID) -->
    <iframe id="sidebarFrame" 
            src="{{ route('admin.sidebar') }}"
            class="fixed left-0 top-0 w-64 min-h-screen border-none z-10">
    </iframe>

    <!-- MAIN CONTENT (HARUS ADA ID) -->
    <div id="mainContent" class="ml-64 p-8 flex-1 transition-all duration-300">

        <!-- TOP BAR -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-[var(--primary)]">Dashboard Keuangan</h2>
                <p class="text-sm text-gray-500 mt-1">Laporan: {{ $yearLabel ?? 'Semua Tahun' }}</p>
            </div>

            <div class="flex items-center gap-4">
                <form action="{{ route('admin.dashboard.index') }}" method="GET" class="flex items-center gap-2">
                    <select name="year_filter" onchange="this.form.submit()" class="bg-white shadow px-4 py-2 rounded-lg text-sm border-gray-300 focus:ring-[#005f37] focus:border-[#005f37] outline-none">
                        <option value="all" {{ $selectedYearParam == 'all' ? 'selected' : '' }}>Akumulasi Semua Tahun</option>
                        @foreach($years as $y)
                            <option value="{{ $y->year }}" {{ $selectedYearParam == $y->year ? 'selected' : '' }}>Tahun {{ $y->year }}</option>
                        @endforeach
                    </select>
                </form>
                <img src="/img/user.png" class="w-10 h-10 rounded-full border" onerror="this.src='https://ui-avatars.com/api/?name=Admin&background=005f37&color=fff'" />
            </div>
        </div>

        @if(!$hasData)
        <div class="bg-white p-12 text-center rounded-xl shadow">
            <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada data keuangan.</h3>
            <p class="text-gray-500 mb-6">Silakan tambahkan data Laporan Keuangan terlebih dahulu.</p>
            <a href="{{ route('admin.financial.index') }}" class="bg-[#005f37] hover:bg-green-800 text-white font-bold py-2 px-6 rounded-lg transition">
                Kelola Laporan Keuangan
            </a>
        </div>
        @else

        <!-- STATS -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-sm text-gray-500">Total Pendapatan</p>
                <h3 class="text-2xl font-semibold mt-1">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                @if($selectedYearParam !== 'all')
                <p class="{{ $growthRev >= 0 ? 'text-green-600' : 'text-red-600' }} text-sm mt-1 font-medium">
                    {{ $growthRev > 0 ? '+' : '' }}{{ number_format($growthRev, 1) }}% vs tahun lalu
                </p>
                @endif
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-sm text-gray-500">Produksi Crusher</p>
                <h3 class="text-2xl font-semibold mt-1">{{ number_format($produksiCrusher, 0, ',', '.') }} ton</h3>
                @if($selectedYearParam !== 'all')
                <p class="{{ $growthProd >= 0 ? 'text-green-600' : 'text-red-600' }} text-sm mt-1 font-medium">
                    {{ $growthProd > 0 ? '+' : '' }}{{ number_format($growthProd, 1) }}% vs tahun lalu
                </p>
                @endif
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-sm text-gray-500">Benefit Crusher</p>
                <h3 class="text-2xl font-semibold mt-1">Rp {{ number_format($benefitCrusher, 0, ',', '.') }}</h3>
                <p class="text-sm text-gray-400 mt-1">
                    {{ $totalPendapatan > 0 ? number_format(($benefitCrusher/$totalPendapatan)*100, 1) : 0 }}% dari total
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-sm text-gray-500">Benefit Sewa</p>
                <h3 class="text-2xl font-semibold mt-1">Rp {{ number_format($benefitSewa, 0, ',', '.') }}</h3>
                <p class="text-sm text-gray-400 mt-1">
                    {{ $totalPendapatan > 0 ? number_format(($benefitSewa/$totalPendapatan)*100, 1) : 0 }}% dari total
                </p>
            </div>

        </div>

        <!-- CHARTS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="font-semibold mb-1">Tren Produksi Crusher</h3>
                <p class="text-sm text-gray-500 mb-4">{{ $yearLabel }}</p>
                <div class="h-52 bg-white rounded-lg relative">
                    <canvas id="productionChart"></canvas>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="font-semibold mb-1">Tren Benefit</h3>
                <p class="text-sm text-gray-500 mb-4">{{ $yearLabel }}</p>
                <div class="h-52 bg-white rounded-lg relative">
                    <canvas id="benefitChart"></canvas>
                </div>
            </div>

        </div>

        <!-- TABLE -->
        <div class="bg-white p-6 rounded-xl shadow">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Ringkasan Laporan</h3>
                <a href="{{ route('admin.financial.index') }}" class="text-sm text-[#005f37] font-semibold hover:underline">Kelola Detail &rarr;</a>
            </div>

            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b">
                        <th class="py-2 text-left">Periode</th>
                        <th class="text-right">Produksi (Ton)</th>
                        <th class="text-right">Benefit Crusher</th>
                        <th class="text-right">Benefit Sewa</th>
                        <th class="text-right">Total Pendapatan</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($tableData as $row)
                    <tr class="border-b">
                        <td class="py-2">{{ $row->label }}</td>
                        <td class="text-right">{{ number_format($row->crusher_production, 0, ',', '.') }}</td>
                        <td class="text-right">
                            <span class="text-green-700">Rp {{ number_format($row->benefit_crusher, 0, ',', '.') }}</span>
                        </td>
                        <td class="text-right">
                            <span class="text-blue-700">Rp {{ number_format($row->benefit_sewa, 0, ',', '.') }}</span>
                        </td>
                        <td class="text-right font-semibold">Rp {{ number_format($row->total_revenue, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada data untuk ditampilkan.</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="bg-gray-50 font-semibold border-t-2 border-gray-200">
                        <td class="py-3 px-2 rounded-bl-lg">TOTAL</td>
                        <td class="text-right">{{ number_format($produksiCrusher, 0, ',', '.') }}</td>
                        <td class="text-right text-green-700">Rp {{ number_format($benefitCrusher, 0, ',', '.') }}</td>
                        <td class="text-right text-blue-700">Rp {{ number_format($benefitSewa, 0, ',', '.') }}</td>
                        <td class="text-right text-[var(--primary)] text-base rounded-br-lg">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>

        </div>

        @endif

    </div>

    <!-- Chart.js Setup -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        @if($hasData)
        const labels = JSON.parse('{!! json_encode($chartLabels) !!}');
        
        // 1. Production Chart (Bar)
        const ctxProd = document.getElementById('productionChart').getContext('2d');
        new Chart(ctxProd, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Produksi Crusher (Ton)',
                    data: JSON.parse('{!! json_encode($chartProd) !!}'),
                    backgroundColor: '#005f37',
                    borderRadius: 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, ticks: { precision: 0 } }
                },
                plugins: { legend: { display: false } }
            }
        });

        // 2. Benefit Chart (Line Dual)
        const ctxBen = document.getElementById('benefitChart').getContext('2d');
        new Chart(ctxBen, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Benefit Crusher',
                        data: JSON.parse('{!! json_encode($chartBenCrush) !!}'),
                        borderColor: '#005f37',
                        backgroundColor: 'rgba(0, 95, 55, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Benefit Sewa',
                        data: JSON.parse('{!! json_encode($chartBenSewa) !!}'),
                        borderColor: '#4f46e5',
                        backgroundColor: 'transparent',
                        borderWidth: 2,
                        borderDash: [5, 5],
                        fill: false,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                },
                plugins: { legend: { display: true, position: 'top' } }
            }
        });
        @endif
    </script>
</body>
</html>