<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arsip_surat', function (Blueprint $table) {
            $table->increments('id_arsip');
            $table->date('tanggal');
            $table->char('jenis', '1');
            $table->string('nomor');
            $table->string('perihal');
            $table->text('url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arsip_surat');
    }
};
