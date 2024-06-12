<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYayasanZakatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yayasan_zakats', function (Blueprint $table) {
            $table->id('id_yayasan_zakat');
            $table->string('nama_yayasan');
            $table->bigInteger('rekapan_beras');
            $table->bigInteger('rekapan_uang');
            $table->string('gambar_surat');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yayasan_zakats');
    }
}
