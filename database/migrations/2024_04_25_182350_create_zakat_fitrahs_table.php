<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZakatFitrahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zakat_fitrahs', function (Blueprint $table) {
            $table->id('id_zakatfitrah');
            $table->string('nama_pezakat');
            $table->float('jumlah_zakat');
            $table->bigInteger('zakat_jenis_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('zakat_jenis_id')->references('id_jenis_zakat')->on('jenis_zakats')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zakat_fitrahs');
    }
}
