<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SiswaTerlambat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa_terlambat', function (Blueprint $table) {
            $table->date('tanggal');
            $table->string('siswa_id');
            $table->time('waktu');
        });
        
        Schema::table('siswa_terlambat', function (Blueprint $table) {
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
        Schema::dropIfExists('siswa_terlambat');
    }
}
