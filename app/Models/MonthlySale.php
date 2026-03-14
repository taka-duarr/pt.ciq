<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlySale extends Model
{
    protected $fillable = [
        'financial_year_id',
        'month',
        'mining_price',
        'mining_production',
        'crusher_price',
        'crusher_production',
        'produksi_ppn',
        'sewa_loader',
        'sewa_dump_truck',
        'sewa_sany',
        'sewa_hyundai_220',
        'sewa_hyundai_330',
        'spare_part',
    ];

    public function financialYear()
    {
        return $this->belongsTo(FinancialYear::class);
    }

    // Accessors for Stone Crusher (Based on Excel Reference)
    
    // 1. PENDAPATAN SEWA CRUSHER
    public function getPendapatanSewaAttribute()
    {
        return $this->crusher_price * $this->crusher_production;
    }

    // 2. PRODUKSI CRUSHER (TON)/PPN (Now manual, formerly 1/3 of production)
    // Laravel will use the database column 'produksi_ppn' automatically

    // 3. TOTAL CRUSHER (15.000)/PPN (Price * Produksi PPN)
    public function getTotalCrusherPpnAttribute()
    {
        return $this->produksi_ppn * $this->crusher_price;
    }

    // 4. PPN 11%
    public function getPpn11Attribute()
    {
        return $this->total_crusher_ppn * 0.11;
    }

    // 5. PPH 2% (2% of Total Crusher PPN)
    public function getPph2Attribute()
    {
        return $this->total_crusher_ppn * 0.02;
    }

    // 6. TOTAL CRUSHER (PPN + PPN 11% - PPH 2%)
    public function getTotalCrusherAkhirAttribute()
    {
        return $this->total_crusher_ppn + $this->ppn_11 - $this->pph_2;
    }

    // 7. BENEFIT CRUSHER (Sewa + Total Akhir)
    public function getBenefitCrusherAttribute()
    {
        return $this->pendapatan_sewa + $this->total_crusher_akhir;
    }

    // Previous Mining Accessors (Keep for now or adjust)
    public function getMiningRevenueAttribute()
    {
        return $this->mining_price * $this->mining_production;
    }

    public function getTotalRevenueAttribute()
    {
        return (float)$this->mining_revenue + (float)$this->benefit_crusher + (float)$this->benefit_sewa;
    }

    // Accessors for Rental (Sewa)
    public function getBenefitSewaAttribute()
    {
        return $this->sewa_loader + 
               $this->sewa_dump_truck + 
               $this->sewa_sany + 
               $this->sewa_hyundai_220 + 
               $this->sewa_hyundai_330 + 
               $this->spare_part;
    }

    public function getMonthNameAttribute()
    {
        $months = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
            9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
        ];
        return $months[$this->month] ?? '-';
    }
}
