<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pesanan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Get total valid orders
        $validStatuses = ['Selesai', 'Telah Sampai', 'Dikirim', 'Diproses'];
        $baseQuery = Pesanan::whereIn('status', $validStatuses);

        $totalPendapatan = $baseQuery->sum('harga_total');
        $totalPesanan = $baseQuery->count();
        $totalTonase = $baseQuery->sum('qty');
        
        // Simple profit calculation (assuming 30% margin for example purposes, as cost is not in DB)
        $profit = $totalPendapatan * 0.30;

        // Growth calculation (this month vs last month)
        $thisMonth = Carbon::now()->month;
        $lastMonth = Carbon::now()->subMonth()->month;

        $revThisMonth = Pesanan::whereIn('status', $validStatuses)->whereMonth('created_at', $thisMonth)->sum('harga_total');
        $revLastMonth = Pesanan::whereIn('status', $validStatuses)->whereMonth('created_at', $lastMonth)->sum('harga_total');
        $growthRev = $revLastMonth > 0 ? (($revThisMonth - $revLastMonth) / $revLastMonth) * 100 : 100;

        $ordThisMonth = Pesanan::whereIn('status', $validStatuses)->whereMonth('created_at', $thisMonth)->count();
        $ordLastMonth = Pesanan::whereIn('status', $validStatuses)->whereMonth('created_at', $lastMonth)->count();
        $growthOrd = $ordLastMonth > 0 ? (($ordThisMonth - $ordLastMonth) / $ordLastMonth) * 100 : 100;

        $tonThisMonth = Pesanan::whereIn('status', $validStatuses)->whereMonth('created_at', $thisMonth)->sum('qty');
        $tonLastMonth = Pesanan::whereIn('status', $validStatuses)->whereMonth('created_at', $lastMonth)->sum('qty');
        $growthTon = $tonLastMonth > 0 ? (($tonThisMonth - $tonLastMonth) / $tonLastMonth) * 100 : 100;

        // Chart Data (Last 30 Days)
        $thirtyDaysAgo = Carbon::now()->subDays(30);
        $chartData = Pesanan::whereIn('status', $validStatuses)
            ->where('created_at', '>=', $thirtyDaysAgo)
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(harga_total) as total_revenue'), DB::raw('COUNT(id) as total_orders'))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $dates = $chartData->pluck('date')->map(function($date) {
            return Carbon::parse($date)->format('d M');
        })->toArray();
        $revenues = $chartData->pluck('total_revenue')->toArray();
        $orders = $chartData->pluck('total_orders')->toArray();

        // Recent Transactions
        $recentTransactions = Pesanan::with('produk')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalPendapatan', 'totalPesanan', 'totalTonase', 'profit',
            'growthRev', 'growthOrd', 'growthTon',
            'dates', 'revenues', 'orders',
            'recentTransactions'
        ));
    }
}
