<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_dt', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_hd_id')->constrained('order_hd');
            $table->foreignId('product_id')->constrained('products');
            $table->integer("total");
            $table->integer("price");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_dt');
    }
};
