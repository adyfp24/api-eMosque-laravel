<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYayasanPenerimaQurbansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yayasan_penerima_qurbans', function (Blueprint $table) {
            $table->id("id_yayasan");
            $table->string("nama_yayasan");
            $table->text("gambar_surat");
            $table->float("total_penerimaan");
            $table->bigInteger("qurban_rekapan_id")->unsigned();
            $table->timestamps();
            
            $table->foreign("qurban_rekapan_id")->references('id_rekapan_qurban')->on('rekapan_qurbans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yayasan_penerima_qurbans');
    }
}
