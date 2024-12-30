<?php

namespace Database\Seeders;

use App\Models\IncomeCategory as ModelsIncomeCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncomeCategory extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Penjualan Produk'],
            ['name' => 'Tip'],
            ['name' => 'Lain - lain']
        ];

        foreach ($data as $data) {
            ModelsIncomeCategory::create($data);
        }
    }
}
