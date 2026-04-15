<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    <h2 style="text-align: center; font-weight: bold; font-size: 16pt;">LAPORAN KEUANGAN PT. CIQ - TAHUN {{ $year->year }}</h2>
    <br>

    <!-- Stone Crusher Table -->
    <table style="border-collapse: collapse; border: 2px solid #000000;">
        <thead>
            <tr>
                <th colspan="10" style="background-color: #c53030; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 5px; font-size: 14pt;">STONE CRUSHER</th>
            </tr>
            <tr>
                <th style="background-color: #c53030; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 5px;">BULAN</th>
                <th style="background-color: #c53030; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 5px;">HARGA (TON)</th>
                <th style="background-color: #c53030; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 5px;">PRODUKSI CRUSHER (TON)</th>
                <th style="background-color: #c53030; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 5px;">PENDAPATAN SEWA CRUSHER</th>
                <th style="background-color: #c53030; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 5px;">PRODUKSI CRUSHER (TON)/PPN</th>
                <th style="background-color: #c53030; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 5px;">TOTAL CRUSHER (15.000)/PPN</th>
                <th style="background-color: #c53030; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 5px;">PPN 11%</th>
                <th style="background-color: #c53030; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 5px;">PPH 2%</th>
                <th style="background-color: #c53030; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 5px;">TOTAL CRUSHER</th>
                <th style="background-color: #c53030; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 5px;">BENEFIT CRUSHER</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totals = [
                    'prod' => 0, 'sewa' => 0, 'prod_ppn' => 0, 't_ppn' => 0, 
                    'ppn' => 0, 'pph' => 0, 't_akhir' => 0, 'benefit' => 0
                ];
            @endphp
            @foreach($monthlySales as $sale)
            <tr>
                <td style="border: 1px solid #000000; text-align: center; padding: 5px;">{{ $sale->month_name }}-{{ substr($year->year, 2) }}</td>
                <td style="border: 1px solid #000000; text-align: right; padding: 5px;">{{ number_format($sale->crusher_price, 3, ',', '.') }}</td>
                <td style="border: 1px solid #000000; text-align: right; padding: 5px;">{{ number_format($sale->crusher_production, 3, ',', '.') }}</td>
                <td style="border: 1px solid #000000; text-align: right; padding: 5px;">{{ number_format($sale->pendapatan_sewa, 3, ',', '.') }}</td>
                <td style="border: 1px solid #000000; text-align: right; padding: 5px;">{{ number_format($sale->produksi_ppn, 3, ',', '.') }}</td>
                <td style="border: 1px solid #000000; text-align: right; padding: 5px;">{{ number_format($sale->total_crusher_ppn, 3, ',', '.') }}</td>
                <td style="border: 1px solid #000000; text-align: right; padding: 5px;">{{ number_format($sale->ppn_11, 3, ',', '.') }}</td>
                <td style="border: 1px solid #000000; text-align: right; padding: 5px;">{{ number_format($sale->pph_2, 3, ',', '.') }}</td>
                <td style="border: 1px solid #000000; text-align: right; padding: 5px; background-color: #f0fff4;">{{ number_format($sale->total_crusher_akhir, 3, ',', '.') }}</td>
                <td style="border: 1px solid #000000; text-align: right; padding: 5px; font-weight: bold;">{{ number_format($sale->benefit_crusher, 3, ',', '.') }}</td>
            </tr>
            @php
                $totals['prod'] += $sale->crusher_production;
                $totals['sewa'] += $sale->pendapatan_sewa;
                $totals['prod_ppn'] += $sale->produksi_ppn;
                $totals['t_ppn'] += $sale->total_crusher_ppn;
                $totals['ppn'] += $sale->ppn_11;
                $totals['pph'] += $sale->pph_2;
                $totals['t_akhir'] += $sale->total_crusher_akhir;
                $totals['benefit'] += $sale->benefit_crusher;
            @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" style="background-color: #fefcbf; font-weight: bold; border: 1px solid #000000; padding: 5px; text-align: center;">TOTAL</td>
                <td style="background-color: #fefcbf; font-weight: bold; border: 1px solid #000000; padding: 5px; text-align: right;">{{ number_format($totals['prod'], 3, ',', '.') }}</td>
                <td style="background-color: #fefcbf; font-weight: bold; border: 1px solid #000000; padding: 5px; text-align: right;">{{ number_format($totals['sewa'], 3, ',', '.') }}</td>
                <td style="background-color: #fefcbf; font-weight: bold; border: 1px solid #000000; padding: 5px; text-align: right;">{{ number_format($totals['prod_ppn'], 3, ',', '.') }}</td>
                <td style="background-color: #fefcbf; font-weight: bold; border: 1px solid #000000; padding: 5px; text-align: right;">{{ number_format($totals['t_ppn'], 3, ',', '.') }}</td>
                <td style="background-color: #fefcbf; font-weight: bold; border: 1px solid #000000; padding: 5px; text-align: right;">{{ number_format($totals['ppn'], 3, ',', '.') }}</td>
                <td style="background-color: #fefcbf; font-weight: bold; border: 1px solid #000000; padding: 5px; text-align: right;">{{ number_format($totals['pph'], 3, ',', '.') }}</td>
                <td style="background-color: #fefcbf; font-weight: bold; border: 1px solid #000000; padding: 5px; text-align: right;">{{ number_format($totals['t_akhir'], 3, ',', '.') }}</td>
                <td style="background-color: #fefcbf; font-weight: bold; border: 1px solid #000000; padding: 5px; text-align: right;">{{ number_format($totals['benefit'], 3, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <br><br>

    <!-- Sewa Table -->
    <table style="border-collapse: collapse; border: 2px solid #000000;">
        <thead>
            <tr>
                <th colspan="8" style="background-color: #742a2a; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 5px; font-size: 14pt;">LAPORAN SEWA</th>
            </tr>
            <tr>
                <th style="background-color: #742a2a; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 5px;">BULAN</th>
                <th style="background-color: #742a2a; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 5px;">LOADER</th>
                <th style="background-color: #742a2a; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 5px;">DUMP TRUCK</th>
                <th style="background-color: #742a2a; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 5px;">SANY</th>
                <th style="background-color: #742a2a; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 5px;">HYUNDAY PC 220</th>
                <th style="background-color: #742a2a; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 5px;">HYUNDAY PC 330</th>
                <th style="background-color: #742a2a; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 5px;">SPARE PART</th>
                <th style="background-color: #742a2a; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 5px;">BENEFIT SEWA</th>
            </tr>
        </thead>
        <tbody>
            @php
                $sTotals = ['l' => 0, 'dt' => 0, 's' => 0, 'h2' => 0, 'h3' => 0, 'sp' => 0, 'b' => 0];
            @endphp
            @foreach($monthlySales as $sale)
            <tr>
                <td style="border: 1px solid #000000; text-align: center; padding: 5px;">{{ $sale->month_name }}-{{ substr($year->year, 2) }}</td>
                <td style="border: 1px solid #000000; text-align: right; padding: 5px;">{{ number_format($sale->sewa_loader, 3, ',', '.') }}</td>
                <td style="border: 1px solid #000000; text-align: right; padding: 5px;">{{ number_format($sale->sewa_dump_truck, 3, ',', '.') }}</td>
                <td style="border: 1px solid #000000; text-align: right; padding: 5px;">{{ number_format($sale->sewa_sany, 3, ',', '.') }}</td>
                <td style="border: 1px solid #000000; text-align: right; padding: 5px;">{{ number_format($sale->sewa_hyundai_220, 3, ',', '.') }}</td>
                <td style="border: 1px solid #000000; text-align: right; padding: 5px;">{{ number_format($sale->sewa_hyundai_330, 3, ',', '.') }}</td>
                <td style="border: 1px solid #000000; text-align: right; padding: 5px; color: #e53e3e;">{{ number_format($sale->spare_part, 3, ',', '.') }}</td>
                <td style="border: 1px solid #000000; text-align: right; padding: 5px; background-color: #f0fff4; font-weight: bold;">{{ number_format($sale->benefit_sewa, 3, ',', '.') }}</td>
            </tr>
            @php
                $sTotals['l'] += $sale->sewa_loader;
                $sTotals['dt'] += $sale->sewa_dump_truck;
                $sTotals['s'] += $sale->sewa_sany;
                $sTotals['h2'] += $sale->sewa_hyundai_220;
                $sTotals['h3'] += $sale->sewa_hyundai_330;
                $sTotals['sp'] += $sale->spare_part;
                $sTotals['b'] += $sale->benefit_sewa;
            @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td style="background-color: #fefcbf; font-weight: bold; border: 1px solid #000000; padding: 5px; text-align: center;">TOTAL</td>
                <td style="background-color: #fefcbf; font-weight: bold; border: 1px solid #000000; padding: 5px; text-align: right;">{{ number_format($sTotals['l'], 3, ',', '.') }}</td>
                <td style="background-color: #fefcbf; font-weight: bold; border: 1px solid #000000; padding: 5px; text-align: right;">{{ number_format($sTotals['dt'], 3, ',', '.') }}</td>
                <td style="background-color: #fefcbf; font-weight: bold; border: 1px solid #000000; padding: 5px; text-align: right;">{{ number_format($sTotals['s'], 3, ',', '.') }}</td>
                <td style="background-color: #fefcbf; font-weight: bold; border: 1px solid #000000; padding: 5px; text-align: right;">{{ number_format($sTotals['h2'], 3, ',', '.') }}</td>
                <td style="background-color: #fefcbf; font-weight: bold; border: 1px solid #000000; padding: 5px; text-align: right;">{{ number_format($sTotals['h3'], 3, ',', '.') }}</td>
                <td style="background-color: #fefcbf; font-weight: bold; border: 1px solid #000000; padding: 5px; text-align: right;">{{ number_format($sTotals['sp'], 3, ',', '.') }}</td>
                <td style="background-color: #fefcbf; font-weight: bold; border: 1px solid #000000; padding: 5px; text-align: right;">{{ number_format($sTotals['b'], 3, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <br><br>

    <!-- Grand Summary -->
    <table style="border-collapse: collapse; border: 2px solid #000000;">
        <thead>
            <tr>
                <th colspan="4" style="background-color: #fefcbf; color: #000000; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 5px; font-size: 14pt;">RINGKASAN LAPORAN</th>
            </tr>
            <tr>
                <th style="background-color: #fefcbf; color: #000000; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 5px;">RINGKASAN BULANAN</th>
                <th style="background-color: #fefcbf; color: #000000; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 5px;">BENEFIT CRUSHER</th>
                <th style="background-color: #fefcbf; color: #000000; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 5px;">BENEFIT SEWA</th>
                <th style="background-color: #fefcbf; color: #000000; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 5px;">TOTAL PENDAPATAN</th>
            </tr>
        </thead>
        <tbody>
            @php $gTotal = 0; @endphp
            @foreach($monthlySales as $sale)
            <tr>
                <td style="border: 1px solid #000000; text-align: center; padding: 5px;">{{ $sale->month_name }}-{{ substr($year->year, 2) }}</td>
                <td style="border: 1px solid #000000; text-align: right; padding: 5px;">{{ number_format($sale->benefit_crusher, 3, ',', '.') }}</td>
                <td style="border: 1px solid #000000; text-align: right; padding: 5px;">{{ number_format($sale->benefit_sewa, 3, ',', '.') }}</td>
                <td style="border: 1px solid #000000; text-align: right; padding: 5px; background-color: #f0fff4; font-weight: bold;">{{ number_format($sale->total_revenue, 3, ',', '.') }}</td>
            </tr>
            @php $gTotal += $sale->total_revenue; @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td style="background-color: #276749; color: #ffffff; font-weight: bold; border: 1px solid #000000; padding: 5px; text-align: center;">GRAND TOTAL</td>
                <td style="background-color: #276749; color: #ffffff; font-weight: bold; border: 1px solid #000000; padding: 5px; text-align: right;">{{ number_format($totals['benefit'], 3, ',', '.') }}</td>
                <td style="background-color: #276749; color: #ffffff; font-weight: bold; border: 1px solid #000000; padding: 5px; text-align: right;">{{ number_format($sTotals['b'], 3, ',', '.') }}</td>
                <td style="background-color: #276749; color: #ffffff; font-weight: bold; border: 1px solid #000000; padding: 5px; text-align: right;">{{ number_format($gTotal, 3, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
