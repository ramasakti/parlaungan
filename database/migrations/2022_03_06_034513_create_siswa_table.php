<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->string('id_siswa')->primary()->onDelete('cascade')->onUpdate('cascade');
            $table->string('rfid')->default('');
            $table->string('nama_siswa');
            $table->integer('kelas_id')->unsigned();
            $table->string('alamat');
            $table->text('telp');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir')->nullable();
        });

        Schema::table('siswa', function (Blueprint $table) {
            $table->foreign('kelas_id')->references('id_kelas')->on('kelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
