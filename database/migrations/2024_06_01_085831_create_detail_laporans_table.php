<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_laporans', function (Blueprint $table) {
            $table->id('id_detail_laporan');
            $table->bigInteger('laporan_id')->unsigned();
            $table->bigInteger('transaksi_id')->unsigned();
            $table->timestamps();

            $table->foreign('laporan_id')->references('id_laporan')->on('laporan_keuangans')->onDelete('cascade');
            $table->foreign('transaksi_id')->references('id_transaksi')->on('transaksis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_laporans');
    }
}
