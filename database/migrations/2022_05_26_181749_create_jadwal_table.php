<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->increments('id_jadwal');
            $table->string('hari');
            $table->string('guru_id');
            $table->integer('kelas_id')->unsigned();
            $table->string('mapel');
            $table->time('mulai');
            $table->time('sampai');
            $table->string('status', '10');
        });

        Schema::table('jadwal', function (Blueprint $table) {
            $table->foreign('guru_id')->references('id_guru')->on('guru');
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
        Schema::dropIfExists('jadwal');
    }
}
