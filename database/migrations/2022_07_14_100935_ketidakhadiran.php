<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ketidakhadiran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inval', function (Blueprint $table) {
            $table->increments('id_inval');
            $table->date('tanggal');
            $table->integer('jadwal_id')->unsigned();
            $table->string('keterangan', '10');
            $table->string('penginval');
        });

        Schema::table('inval', function (Blueprint $table) {
            $table->foreign('jadwal_id')->references('id_jadwal')->on('jadwal')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('inval', function (Blueprint $table) {
            $table->foreign('penginval')->references('id_guru')->on('guru')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inval');
    }
}
