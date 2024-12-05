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
        Schema::create('order_hd', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("name");
            $table->integer("total_product");
            $table->integer("total_price");
            $table->string("payment_method");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_hd');
    }
};
