<?php

namespace Tests\Feature;

use App\Models\OrderHd;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderDTTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_with_valid_data() {
        $orderHd = OrderHd::factory()->create();
        $product = Product::factory()->create();

        $payload = [
            'order_hd_id' => $orderHd->id,
            'product_id' => $product->id,
            'total' => 10,
            'price' => 1000,
        ];

        $response = $this->postJson('/inputorderdt', $payload);

        $response->assertStatus(201)
                ->assertJsonStructure([
                    'order_hd_id',
                    'product_id',
                    'total',
                    'price',
                ]);
        
        $this->assertDatabaseHas('order_dt', [
            'order_hd_id' => $orderHd->id,
            'product_id' => $product->id,
            'total' => 10,
            'price' => 1000,
        ]);
    }
}
