<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FinancialExport implements FromView, ShouldAutoSize
{
    protected $year;
    protected $monthlySales;

    public function __construct($year, $monthlySales)
    {
        $this->year = $year;
        $this->monthlySales = $monthlySales;
    }

    public function view(): View
    {
        return view('admin.exports.financial_excel', [
            'year' => $this->year,
            'monthlySales' => $this->monthlySales
        ]);
    }
}
