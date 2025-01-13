<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OutcomeByProductExport implements FromQuery, WithHeadings, ShouldAutoSize
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama Produk',
            'Jumlah',
            'Pengeluaran'
        ];
    }

    public function query()
    {
        return DB::table('wira.vtransaction_stock_dt')
            ->selectRaw("DATE_FORMAT(created_at, '%e %b %Y'), product_name, total, price")
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->orderByDesc('created_at');
    }
}
