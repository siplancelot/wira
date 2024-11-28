<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $categories = [
            ['name' => 'Makanan', 'items' => [
                ['name' => 'Mie Goreng', 'price' => 8000, 'variants' => [
                    ['name' => 'Mie Goreng Biasa', 'price' => 8000],
                    ['name' => 'Mie Goreng Aceh', 'price' => 8000],
                    ['name' => 'Mie Goreng Rendang', 'price' => 8000],
                ]],
                ['name' => 'Mie Kuah', 'price' => 8000, 'variants' => [
                    ['name' => 'Mie Kuah Soto', 'price' => 8000],
                    ['name' => 'Mie Kuah Kari', 'price' => 8000],
                    ['name' => 'Mie Kuah Ayam Bawang', 'price' => 8000]
                ]],
                ['name' => 'Mie Goreng Double', 'price' => 14000, 'variants' => [
                    ['name' => 'Mie Goreng Biasa', 'price' => 8000],
                    ['name' => 'Mie Goreng Aceh', 'price' => 8000],
                    ['name' => 'Mie Goreng Rendang', 'price' => 8000],
                ]],
                ['name' => 'Mie Kuah Double', 'price' => 14000, 'variants' => [
                    ['name' => 'Mie Kuah Soto', 'price' => 8000],
                    ['name' => 'Mie Kuah Kari', 'price' => 8000],
                    ['name' => 'Mie Kuah Ayam Bawang', 'price' => 8000]
                ]],
                ['name' => 'Nasi', 'price' => 10000, 'variants' => [
                    ['name' => 'Nasi Telor', 'price' => 10000],
                    ['name' => 'Nasi Bakar', 'price' => 13000],
                    ['name' => 'Nasi Nugget + Sosis', 'price' => 15000],
                    ['name' => 'Nasi Katsu', 'price' => 15000]
                ]],
                ['name' => 'Roti Bakar', 'price' => 10000, 'variants' => [
                    ['name' => 'Roti Bakar Coklat', 'price' => 10000],
                    ['name' => 'Roti Bakar Strawberry', 'price' => 10000],
                    ['name' => 'Roti Bakar Strawberry + Susu', 'price' => 13000],
                    ['name' => 'Roti Bakar Coklat + Susu', 'price' => 13000],
                    ['name' => 'Roti Bakar Coklat + Susu + Keju', 'price' => 15000],
                    ['name' => 'Roti Bakar Coklat + Strawberry', 'price' => 15000],
                ]],
                ['name' => 'Kentang Goreng', 'price' => 10000],
                ['name' => 'Sosis Goreng', 'price' => 10000],
                ['name' => 'Nugget Goreng', 'price' => 10000],
                ['name' => 'Otak - Otak Goreng', 'price' => 10000],
                ['name' => 'Mendoan (5pcs)', 'price' => 10000],
                ['name' => 'Mix Platter', 'price' => 20000],
                ['name' => 'Omlet', 'price' => 15000],
            ]],
            ['name' => 'Minuman', 'items' => [
                ['name' => 'Air Mineral 600ml', 'price' => 5000],
                ['name' => 'Kopi', 'price' => 5000],
                ['name' => 'Teh Manis / Tawar', 'price' => 5000],
                ['name' => 'Teh Susu / Teh Tarik', 'price' => 7000],
                ['name' => 'Teh Lemon', 'price' => 7000],
                ['name' => 'Good Day Mocca', 'price' => 7000],
                ['name' => 'Good Day Cappucino', 'price' => 7000],
                ['name' => 'Nutrisari', 'price' => 7000],
                ['name' => 'Susu Jahe', 'price' => 7000],
                ['name' => 'Beng - Beng', 'price' => 7000],
                ['name' => 'Susu (Coklat / Putih)', 'price' => 7000],
                ['name' => 'Milo', 'price' => 7000],
                ['name' => 'Extra Joss / Kukubima', 'price' => 7000],
                ['name' => 'Extra Joss / Kukubima + susu', 'price' => 10000],
                ['name' => 'Milo Susu', 'price' => 10000],
                ['name' => 'Nutrisari + Susu', 'price' => 10000],
                ['name' => 'Jahe + Wedang Uwuh', 'price' => 10000],
                ['name' => 'Soda Gembira', 'price' => 10000],
                ['name' => 'Telang Lemon', 'price' => 12000],
                ['name' => 'Telang Susu', 'price' => 12000],
                ['name' => 'Rosela Squash', 'price' => 12000],
                ['name' => 'Jahe Soda', 'price' => 12000],
            ]],
            ['name' => 'Tambahan', 'items' => [
                ['name' => 'Susu Untuk Minuman', 'price' => 3000],
                ['name' => 'Telur', 'price' => 5000],
            ]],
        ];

        foreach ($categories as $categoryData) {
            $category = Category::create(['category_name' => $categoryData['name']]);

            foreach ($categoryData['items'] as $itemData) {
                $product = Product::create([
                    'category_id' =>  $category->id,
                    'product_name' => $itemData['name'],
                    'buy_price' => $itemData['price'],
                    'sell_price' => $itemData['price'],
                    'product_image' => null,
                    'product_description' => $faker->paragraph(2),
                    'parent_id' => 0,
                ]);

                Stock::create([
                    'product_id' => $product->id,
                    'stock' => 0,

                ]);

                if (isset($itemData['variants'])) {
                    foreach ($itemData['variants'] as $variantData) {
                        $variant = Product::create([
                            'category_id' => $category->id,
                            'product_name' => $variantData['name'],
                            'buy_price' => $itemData['price'],
                            'sell_price' => $itemData['price'],
                            'product_image' => null,
                            'product_description' => $faker->paragraph(2),
                            'parent_id' => $product->id,
                        ]);

                        Stock::create([
                            'product_id' => $variant->id,
                            'stock' => 0,
                        ]);
                    }
                }
            }
        }
    }
}
