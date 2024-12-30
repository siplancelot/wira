<?php

namespace Database\Seeders;

use App\Models\OutcomeCategory as ModelsOutcomeCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OutcomeCategory extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Pembelian Produk'],
            ['name' => 'Service / Perbaikan'],
            ['name' => 'Lain - lain']
        ];

        foreach ($data as $data) {
            ModelsOutcomeCategory::create($data);
        }
    }
}
