<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetailSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_siswa', function (Blueprint $table) {
            $table->string('siswa_id');
            $table->string('nisn')->nullable();
            $table->string('nik')->nullable();
            $table->string('nokk')->nullable();
            $table->char('transportasi', '2')->nullable();
            $table->char('anak', '2')->nullable();
            $table->char('jenis_tinggal', '2')->nullable();
            $table->string('askol')->nullable();
            $table->string('ibu')->nullable();
            $table->string('nik_ibu')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->char('profesi_ibu', '2')->nullable();
            $table->string('penghasilan_ibu')->nullable();
            $table->string('ayah')->nullable();
            $table->string('nik_ayah')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->char('profesi_ayah', '2')->nullable();
            $table->string('penghasilan_ayah')->nullable();
            $table->integer('tinggi')->nullable();
            $table->integer('berat')->nullable();
        });

        Schema::table('detail_siswa', function (Blueprint $table) {
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
        Schema::dropIfExists('detail_siswa');
    }
}
