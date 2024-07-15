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
        Schema::create('keranjang', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('transaksi_id')->unsigned()->nullable();
            $table->bigInteger('product_id')->unsigned();
            $table->integer('total');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('transaksi_id')->references('id')->on('transaksi');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang');
    }
};
