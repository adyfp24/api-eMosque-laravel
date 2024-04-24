<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekapanZakatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekapan_zakats', function (Blueprint $table) {
            $table->id('id_rekapan_zakat');
            $table->float('rekapan_total_uang');
            $table->float('rekapan_total_beras');
            $table->date('tgl_rekapan');
            $table->integer('jenis_rekapan_id');
            $table->integer('jenis_rekapan_id')->unsigned();
            $table->integer('jenis_zakat_id')->unsigned();
            $table->integer('yayasan_id')->unsigned();
            $table->timestamps();

            $table->foreign('jenis_rekapan_id')->references('id_jenis_rekapan')->on('jenis_rekapan')->onDelete('cascade');
            $table->foreign('jenis_zakat_id')->references('id_jenis_zakat')->on('jenis_zakat')->onDelete('cascade');
            $table->foreign('yayasan_id')->references('id_yayasan')->on('yayasan_penerima_zakat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekapan_zakats');
    }
}
