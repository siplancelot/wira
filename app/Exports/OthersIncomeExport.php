<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OthersIncomeExport implements FromQuery, WithHeadings, ShouldAutoSize, WithStyles
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
            'Tipe Pemasukan',
            'Jumlah'
        ];
    }

    public function query()
    {
        return DB::table('incomes')
            ->join('income_categories', 'incomes.income_category_id', '=', 'income_categories.id')
            ->selectRaw("DATE_FORMAT(incomes.created_at, '%e %b %Y'), incomes.total, income_categories.name")
            ->whereBetween('incomes.created_at', [$this->startDate, $this->endDate])
            ->whereNot('income_categories.name', 'Penjualan Produk')
            ->orderByDesc('incomes.created_at');
    }
}
