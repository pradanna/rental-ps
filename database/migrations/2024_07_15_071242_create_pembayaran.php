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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaksi_id')->unsigned();
            $table->date('tanggal');
            $table->string('bank');
            $table->string('atas_nama');
            $table->text('bukti');
            $table->text('deskripsi');
            $table->smallInteger('status')->default(0);
            $table->timestamps();
            $table->foreign('transaksi_id')->references('id')->on('transaksi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
