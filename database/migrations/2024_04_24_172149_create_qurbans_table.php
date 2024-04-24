<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQurbansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qurbans', function (Blueprint $table) {
            $table->id("id_qurban");
            $table->string("nama_orang_berqurban");
            $table->date("tanggal");
            $table->string("dokumentasi");
            $table->text("deskripsi");
            $table->bigInteger("qurban_jenis_id")->unsigned();
            $table->timestamps();
            
            $table->foreign('qurban_jenis_id')->references('id_jenis_qurban')->on('jenis_qurbans')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qurbans');
    }
}
