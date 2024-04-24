<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id('id_kegiatan');
            $table->string('nama_kegiatan');
            $table->bigInteger('detail_kegiatan_id')->unsigned();
            $table->bigInteger('perizinan_id')->unsigned();
            $table->bigInteger('penanggung_jawab_id')->unsigned();
            $table->timestamps();

            $table->foreign('detail_kegiatan_id')->references('id_detail_kegiatan')->on('detail_kegiatans');
            $table->foreign('perizinan_id')->references('id_perizinan')->on('perizinans');
            $table->foreign('penanggung_jawab_id')->references('id_penanggung_jawab')->on('penanggung_jawabs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kegiatans');
    }
}
