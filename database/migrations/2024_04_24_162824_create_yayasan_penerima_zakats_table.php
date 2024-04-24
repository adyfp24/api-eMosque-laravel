<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYayasanPenerimaZakatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yayasan_penerima_zakats', function (Blueprint $table) {
            $table->id('id_yayasan');
            $table->string('nama_yayasan');
            $table->text('gambar_surat');
            $table->float('total_penerimaan');
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
        Schema::dropIfExists('yayasan_penerima_zakats');
    }
}
