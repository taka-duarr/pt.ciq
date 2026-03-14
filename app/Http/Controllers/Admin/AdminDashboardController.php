<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FinancialYear;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $years = FinancialYear::orderBy('year', 'asc')->get();
        
        // Try to get from request, fallback to session, default to 'all'
        $selectedYearParam = $request->get('year_filter');
        
        if ($selectedYearParam) {
            session(['dashboard_year_filter' => $selectedYearParam]);
        } else {
            $selectedYearParam = session('dashboard_year_filter', 'all');
        }

        $totalPendapatan = 0;
        $produksiCrusher = 0;
        $benefitCrusher = 0;
        $benefitSewa = 0;

        $chartLabels = [];
        $chartProd = [];
        $chartBenCrush = [];
        $chartBenSewa = [];
        
        $tableData = []; 

        $growthRev = 0;
        $growthProd = 0;
        
        $hasData = true;

        if ($years->isEmpty()) {
            $hasData = false;
            $yearLabel = 'Semua Tahun';
            return view('admin.dashboard', compact(
                'years', 'selectedYearParam', 'totalPendapatan', 'produksiCrusher', 'benefitCrusher', 'benefitSewa',
                'chartLabels', 'chartProd', 'chartBenCrush', 'chartBenSewa', 'tableData', 'growthRev', 'growthProd',
                'hasData', 'yearLabel'
            ));
        }

        if ($selectedYearParam === 'all') {
            $yearLabel = 'Akumulasi Semua Tahun';
            
            // Loop through all years and aggregate
            // Sort ascending for charts
            $yearsData = FinancialYear::with('monthlySales')->orderBy('year', 'asc')->get();
            
            $tempTableData = [];

            foreach($yearsData as $fy) {
                $y_pendapatan = $fy->monthlySales->sum('total_revenue');
                $y_produksi = $fy->monthlySales->sum('crusher_production');
                $y_ben_crush = $fy->monthlySales->sum('benefit_crusher');
                $y_ben_sewa = $fy->monthlySales->sum('benefit_sewa');

                $totalPendapatan += $y_pendapatan;
                $produksiCrusher += $y_produksi;
                $benefitCrusher += $y_ben_crush;
                $benefitSewa += $y_ben_sewa;

                $chartLabels[] = $fy->year;
                $chartProd[] = $y_produksi;
                $chartBenCrush[] = $y_ben_crush;
                $chartBenSewa[] = $y_ben_sewa;

                $tempTableData[] = (object)[
                    'label' => 'Tahun ' . $fy->year,
                    'crusher_production' => $y_produksi,
                    'benefit_crusher' => $y_ben_crush,
                    'benefit_sewa' => $y_ben_sewa,
                    'total_revenue' => $y_pendapatan
                ];
            }
            
            // For table, let's reverse to show latest year top
            $tableData = array_reverse($tempTableData);

        } else {
            $targetYear = FinancialYear::with('monthlySales')->where('year', $selectedYearParam)->first();
            if (!$targetYear) {
                $targetYear = $years->first();
                $selectedYearParam = $targetYear->year;
            }
            
            $yearLabel = 'Tahun ' . $targetYear->year;
            $monthlySales = $targetYear->monthlySales->sortBy('month');

            $totalPendapatan = $monthlySales->sum('total_revenue');
            $produksiCrusher = $monthlySales->sum('crusher_production');
            $benefitCrusher = $monthlySales->sum('benefit_crusher');
            $benefitSewa = $monthlySales->sum('benefit_sewa');

            // Growth vs Prev Year
            $prevYear = FinancialYear::where('year', $targetYear->year - 1)->first();
            if ($prevYear) {
                $prevSales = $prevYear->monthlySales;
                $prevTotalRev = $prevSales->sum('total_revenue');
                $prevTotalProd = $prevSales->sum('crusher_production');

                if ($prevTotalRev > 0) {
                    $growthRev = (($totalPendapatan - $prevTotalRev) / $prevTotalRev) * 100;
                } else {
                    $growthRev = $totalPendapatan > 0 ? 100 : 0;
                }

                if ($prevTotalProd > 0) {
                    $growthProd = (($produksiCrusher - $prevTotalProd) / $prevTotalProd) * 100;
                } else {
                    $growthProd = $produksiCrusher > 0 ? 100 : 0;
                }
            }

            foreach ($monthlySales as $sale) {
                $chartLabels[] = $sale->month_name;
                $chartProd[] = $sale->crusher_production;
                $chartBenCrush[] = $sale->benefit_crusher;
                $chartBenSewa[] = $sale->benefit_sewa;
                
                $tableData[] = (object)[
                    'label' => $sale->month_name,
                    'crusher_production' => $sale->crusher_production,
                    'benefit_crusher' => $sale->benefit_crusher,
                    'benefit_sewa' => $sale->benefit_sewa,
                    'total_revenue' => $sale->total_revenue
                ];
            }
        }

        return view('admin.dashboard', compact(
            'years', 'selectedYearParam', 'hasData', 'yearLabel',
            'totalPendapatan', 'produksiCrusher', 'benefitCrusher', 'benefitSewa',
            'chartLabels', 'chartProd', 'chartBenCrush', 'chartBenSewa',
            'tableData', 'growthRev', 'growthProd'
        ));
    }
}
