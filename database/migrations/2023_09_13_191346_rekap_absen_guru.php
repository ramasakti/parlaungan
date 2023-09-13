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
        Schema::create('rekap_absen_guru', function (Blueprint $table) {
            $table->id();
            $table->string('id_guru');
            $table->date('tanggal');
            $table->text('keterangan');
        });

        Schema::table('rekap_absen_guru', function (Blueprint $table) {
            $table->foreign('id_guru')->references('id_guru')->on('guru');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekap_absen_guru');
    }
};
