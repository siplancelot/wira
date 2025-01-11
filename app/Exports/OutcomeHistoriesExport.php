<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OutcomeHistoriesExport implements FromQuery, WithHeadings
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
            'Total Pesanan',
            'Jumlah',
        ];
    }

    public function query()
    {
        return DB::table('transaction_stock_hd')
            ->selectRaw("DATE_FORMAT(created_at, '%e %b %Y'), total, price")
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->orderByDesc('created_at');
    }
}
