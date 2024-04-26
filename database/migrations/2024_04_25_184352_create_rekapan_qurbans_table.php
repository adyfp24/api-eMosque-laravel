<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekapanQurbansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekapan_qurbans', function (Blueprint $table) {
            $table->id('id_rekapan_qurban');
            $table->float('rekapan_total_daging_kambing');
            $table->float('rekapan_total_daging_sapi');
            $table->date('tgl_rekapan');
            $table->bigInteger('rekapan_jenis_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('rekapan_jenis_id')->references('id_jenis_rekapan')->on('jenis_rekapans')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekapan_qurbans');
    }
}
