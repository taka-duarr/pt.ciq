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
            class="fixed left-0 top-0 w-64 min-h-screen border-none">
    </iframe>

    <!-- MAIN CONTENT (HARUS ADA ID) -->
    <div id="mainContent" class="ml-64 p-8 flex-1 transition-all duration-300">

        <!-- TOP BAR -->
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-[var(--primary)]">Dashboard</h2>

            <div class="flex items-center gap-4">
                <input type="text" placeholder="Cari…" 
                       class="bg-white shadow px-4 py-2 rounded-lg text-sm">
                <img src="img/user.png"
                     class="w-10 h-10 rounded-full border" />
            </div>
        </div>

        <!-- STATS -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-sm text-gray-500">Pendapatan</p>
                <h3 class="text-2xl font-semibold mt-1">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                <p class="{{ $growthRev >= 0 ? 'text-green-600' : 'text-red-600' }} text-sm mt-1">
                    {{ $growthRev > 0 ? '+' : '' }}{{ number_format($growthRev, 1) }}% dari bulan lalu
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-sm text-gray-500">Total Pesanan</p>
                <h3 class="text-2xl font-semibold mt-1">{{ number_format($totalPesanan, 0, ',', '.') }}</h3>
                <p class="{{ $growthOrd >= 0 ? 'text-green-600' : 'text-red-600' }} text-sm mt-1">
                    {{ $growthOrd > 0 ? '+' : '' }}{{ number_format($growthOrd, 1) }}% dari bulan lalu
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-sm text-gray-500">Total Tonase</p>
                <h3 class="text-2xl font-semibold mt-1">{{ number_format($totalTonase, 0, ',', '.') }} ton</h3>
                <p class="{{ $growthTon >= 0 ? 'text-green-600' : 'text-red-600' }} text-sm mt-1">
                    {{ $growthTon > 0 ? '+' : '' }}{{ number_format($growthTon, 1) }}% dari bulan lalu
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-sm text-gray-500">Estimasi Profit (30%)</p>
                <h3 class="text-2xl font-semibold mt-1">Rp {{ number_format($profit, 0, ',', '.') }}</h3>
                <p class="{{ $growthRev >= 0 ? 'text-green-600' : 'text-red-600' }} text-sm mt-1">
                    {{ $growthRev > 0 ? '+' : '' }}{{ number_format($growthRev, 1) }}% dari bulan lalu
                </p>
            </div>

        </div>

        <!-- CHARTS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="font-semibold mb-1">Total Penjualan (Pesanan)</h3>
                <p class="text-sm text-gray-500 mb-4">30 hari terakhir</p>
                <div class="h-52 bg-white rounded-lg relative">
                    <canvas id="ordersChart"></canvas>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="font-semibold mb-1">Pendapatan</h3>
                <p class="text-sm text-gray-500 mb-4">30 hari terakhir</p>
                <div class="h-52 bg-white rounded-lg relative">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

        </div>

        <!-- TABLE -->
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold mb-4">Transaksi Terbaru</h3>

            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b">
                        <th class="py-2 text-left">Customer</th>
                        <th class="text-left">Tanggal</th>
                        <th class="text-left">Produk</th>
                        <th class="text-left">Tonase</th>
                        <th class="text-left">Lokasi</th>
                        <th class="text-left">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($recentTransactions as $trx)
                    <tr class="border-b">
                        <td class="py-2">{{ $trx->nama_pemesan }}</td>
                        <td>{{ $trx->created_at->format('d/m/Y') }}</td>
                        <td>{{ $trx->produk->nama ?? '-' }}</td>
                        <td>{{ $trx->qty }} ton</td>
                        <td>{{ $trx->alamat ?? '-' }}</td>
                        <td>
                            <span class="px-3 py-1 rounded-full text-xs
                                {{ $trx->status === 'Selesai' || $trx->status === 'Telah Sampai' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $trx->status === 'Diproses' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $trx->status === 'Dikirim' ? 'bg-blue-100 text-blue-700' : '' }}
                                {{ $trx->status === 'Dibatalkan' ? 'bg-red-100 text-red-700' : '' }}
                            ">
                                {{ $trx->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500">Belum ada transaksi terbaru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

    </div>

    <!-- Chart.js Setup -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartLabels = JSON.parse('{!! json_encode($dates) !!}');
        const orderData = JSON.parse('{!! json_encode($orders) !!}');
        const revenueData = JSON.parse('{!! json_encode($revenues) !!}');

        // Orders Chart (Bar)
        const ctxOrders = document.getElementById('ordersChart').getContext('2d');
        new Chart(ctxOrders, {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Jumlah Pesanan',
                    data: orderData,
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

        // Revenue Chart (Line)
        const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctxRevenue, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: revenueData,
                    borderColor: '#005f37',
                    backgroundColor: 'rgba(0, 95, 55, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                },
                plugins: { legend: { display: false } }
            }
        });
    </script>

</body>
</html>