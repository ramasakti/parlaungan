<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurnalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnal', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('jadwal_id')->unsigned();
            $table->time('masuk');
            $table->integer('lama');
            $table->boolean('transport');
            $table->text('materi');
        });

        Schema::table('jurnal', function (Blueprint $table) {
            $table->foreign('jadwal_id')->references('id_jadwal')->on('jadwal')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jurnal');
    }
}
