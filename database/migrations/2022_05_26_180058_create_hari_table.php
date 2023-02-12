<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHariTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hari', function (Blueprint $table) {
            $table->increments('id_hari');
            $table->string('nama_hari');
            $table->time('masuk');
            $table->time('pulang');
            $table->time('jampel');
            $table->string('piket');
            $table->boolean('status');
        });

        Schema::table('hari', function (Blueprint $table) {
            $table->foreign('piket')->references('id_guru')->on('guru');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hari');
    }
}
