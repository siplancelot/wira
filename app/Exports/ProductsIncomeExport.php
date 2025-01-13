<?php

namespace App\Exports;

use App\Models\OrderHd;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductsIncomeExport implements FromQuery, WithHeadings, ShouldAutoSize, WithStyles
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
