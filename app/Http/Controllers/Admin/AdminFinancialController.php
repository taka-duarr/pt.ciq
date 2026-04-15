<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FinancialYear;
use App\Models\MonthlySale;
use Illuminate\Http\Request;

class AdminFinancialController extends Controller
{
    public function index(Request $request)
    {
        $years = FinancialYear::orderBy('year', 'asc')->get();
        
        $selectedYearId = $request->get('year_id') ?: session('selected_financial_year_id');
        
        if (!$selectedYearId && $years->count() > 0) {
            $selectedYearId = $years->first()->id;
        }

        if ($selectedYearId) {
            session(['selected_financial_year_id' => $selectedYearId]);
        }

        $selectedYear = FinancialYear::with('monthlySales')->find($selectedYearId);
        $monthlySales = $selectedYear ? $selectedYear->monthlySales->sortBy('month') : collect();

        // Calculate yearly totals
        $totals = [
            'mining_revenue' => $monthlySales->sum(function($sale) { return $sale->mining_revenue; }),
            'crusher_revenue' => $monthlySales->sum(function($sale) { return $sale->benefit_crusher; }),
            'sewa_revenue' => $monthlySales->sum(function($sale) { return $sale->benefit_sewa; }),
            'total_revenue' => $monthlySales->sum(function($sale) { return $sale->total_revenue; }),
            'mining_production' => $monthlySales->sum('mining_production'),
            'crusher_production' => $monthlySales->sum('crusher_production'),
        ];

        return view('admin.financial', compact('years', 'selectedYear', 'monthlySales', 'totals'));
    }

    public function storeYear(Request $request)
    {
        $request->validate([
            'year' => 'required|numeric|unique:financial_years,year'
        ]);

        $financialYear = FinancialYear::create([
            'year' => $request->year
        ]);

        // Initialize 12 months
        for ($m = 1; $m <= 12; $m++) {
            MonthlySale::create([
                'financial_year_id' => $financialYear->id,
                'month' => $m,
                'mining_price' => 0,
                'mining_production' => 0,
                'crusher_price' => 0,
                'crusher_production' => 0,
                'sewa_loader' => 0,
                'sewa_dump_truck' => 0,
                'sewa_sany' => 0,
                'sewa_hyundai_220' => 0,
                'sewa_hyundai_330' => 0,
                'spare_part' => 0,
            ]);
        }

        return redirect()->route('admin.financial.index', ['year_id' => $financialYear->id])
                         ->with('success', 'Tahun ' . $request->year . ' berhasil ditambahkan.');
    }

    public function updateMonthly(Request $request, $id)
    {
        $sale = MonthlySale::findOrFail($id);
        
        $data = $request->validate([
            'crusher_price' => 'numeric',
            'crusher_production' => 'numeric',
            'produksi_ppn' => 'numeric',
            'sewa_loader' => 'numeric',
            'sewa_dump_truck' => 'numeric',
            'sewa_sany' => 'numeric',
            'sewa_hyundai_220' => 'numeric',
            'sewa_hyundai_330' => 'numeric',
            'spare_part' => 'numeric',
        ]);

        $sale->update($data);

        return response()->json([
            'success' => true,
            'mining_revenue' => number_format($sale->mining_revenue, 3, ',', '.'),
            'crusher_revenue' => number_format($sale->benefit_crusher, 3, ',', '.'),
            'sewa_benefit' => number_format($sale->benefit_sewa, 3, ',', '.'),
            'total_revenue' => number_format($sale->total_revenue, 3, ',', '.'),
        ]);
    }

    public function updateYear(Request $request, $id)
    {
        $year = FinancialYear::findOrFail($id);
        
        $request->validate([
            'year' => 'required|numeric|unique:financial_years,year,' . $id
        ]);

        $year->update(['year' => $request->year]);

        return redirect()->back()->with('success', 'Tahun berhasil diperbarui.');
    }

    public function destroyYear($id)
    {
        $year = FinancialYear::findOrFail($id);
        $year->delete(); // Cascade delete monthly_sales should be handled by DB or Model if defined

        // Clear session if the deleted year was selected
        if (session('selected_financial_year_id') == $id) {
            session()->forget('selected_financial_year_id');
        }

        return redirect()->route('admin.financial.index')->with('success', 'Tahun berhasil dihapus.');
    }

    public function exportExcel($id)
    {
        $year = FinancialYear::with('monthlySales')->findOrFail($id);
        $monthlySales = $year->monthlySales->sortBy('month');

        $filename = "Laporan_Keuangan_" . $year->year . ".xlsx";

        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\FinancialExport($year, $monthlySales), $filename);
    }
}
