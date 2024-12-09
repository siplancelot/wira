<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderHDTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_with_valid_data() {
        $payload = [
            'title' => 'Pemesanan',
            'name' => 'Joko',
            'total_product' => 10,
            'total_price' => 1000,
            'payment_method' => 'BCA',
        ];

        $response = $this->postJson('/inputorderhd', $payload);

        $response->assertStatus(201)
                ->assertJsonStructure([
                    'id'
                ]);
        
        $this->assertDatabaseHas('order_hd', [
            'title' => 'Pemesanan',
            'name' => 'Joko',
            'total_product' => 10,
            'total_price' => 1000,
            'payment_method' => 'BCA',
        ]);
    }
}
