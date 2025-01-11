<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OtherOutcomesExport implements FromQuery, WithHeadings
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
            'Tipe Pengeluaran',
            'Total',
        ];
    }

    public function query()
    {
        return DB::table('outcomes')
            ->join('outcome_categories', 'outcomes.outcome_category_id', '=', 'outcome_categories.id')
            ->selectRaw("DATE_FORMAT(outcomes.created_at, '%e %b %Y'), outcome_categories.name, outcomes.total")
            ->whereBetween('outcomes.created_at', [$this->startDate, $this->endDate])
            ->whereNot('outcome_categories.name', 'Pembelian Produk')
            ->orderByDesc('created_at');
    }
}
