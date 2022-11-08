<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Walmur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('walmur', function (Blueprint $table) {
            $table->string('id_walmur');
            $table->string('siswa_id');
            $table->text('nama_walmur');
            $table->date('telp');
        });

        Schema::table('walmur', function (Blueprint $table) {
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
        Schema::dropIfExists('walmur');
    }
}
