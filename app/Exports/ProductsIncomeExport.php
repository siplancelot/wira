<?php

namespace App\Exports;

use App\Models\OrderHd;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsIncomeExport implements FromQuery, WithHeadings
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
            'Jumlah Produk',
            'Total Harga'
        ];
    }

    public function query()
    {
        return OrderHd::selectRaw("DATE_FORMAT(created_at, '%e %b %Y'), total_product, total_price")
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->orderByDesc('created_at');
    }
}
