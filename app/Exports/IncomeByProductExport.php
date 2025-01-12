<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class IncomeByProductExport implements FromQuery, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama Produk',
            'Jumlah',
            'Pemasukan',
            'Total Modal',
            'Keuntungan'
        ];
    }

    public function query()
    {
        return DB::table('wira.vorder_dt')
            ->selectRaw("DATE_FORMAT(created_at, '%e %b %Y'), product_name, total, sell_price * total AS revenue, buy_price * total AS capital, sell_price * total - buy_price * total AS profit")
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->orderByDesc('created_at');
    }
}
