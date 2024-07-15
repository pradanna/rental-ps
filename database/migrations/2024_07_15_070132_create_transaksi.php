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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('no_peminjaman')->unique();
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->integer('sub_total')->default(0);
            $table->integer('dp')->default(0);
            $table->integer('denda')->default(0);
            $table->integer('total')->default(0);
            $table->boolean('lunas')->default(false);
            $table->string('alamat');
            $table->smallInteger('status')->default(0);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
