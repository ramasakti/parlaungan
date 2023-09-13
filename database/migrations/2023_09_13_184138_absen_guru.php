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
        Schema::create('absen_guru', function (Blueprint $table) {
            $table->string('id_guru')->primary();
            $table->time('waktu_absen')->nullable();
            $table->text('keterangan');
        });

        Schema::table('absen_guru', function (Blueprint $table) {
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
        Schema::dropIfExists('absen_guru');
    }
};
