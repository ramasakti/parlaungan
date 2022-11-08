<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->text('kwitansi');
            $table->datetime('waktu_transaksi');
            $table->string('siswa_id');
            $table->foreignId('pembayaran_id')->references('id_pembayaran')->on('pembayaran')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('terbayar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
