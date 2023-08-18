<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RekapSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekap_siswa', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('siswa_id');
            $table->char('keterangan', 1);
            $table->time('waktu_absen')->nullable();
        });

        Schema::table('rekap_siswa', function (Blueprint $table) {
            $table->foreign('siswa_id')->references('id_siswa')->on('siswa')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekap_siswa');
    }
}
