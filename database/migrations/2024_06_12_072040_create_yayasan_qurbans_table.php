<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYayasanQurbansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yayasan_qurbans', function (Blueprint $table) {
            $table->id('id_yayasan_qurban');
            $table->string('nama_yayasan');
            $table->bigInteger('rekapan_kambing');
            $table->bigInteger('rekapan_sapi');
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
        Schema::dropIfExists('yayasan_qurbans');
    }
}
