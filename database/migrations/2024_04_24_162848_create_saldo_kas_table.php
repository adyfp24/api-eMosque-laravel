<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaldoKasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saldo_kas', function (Blueprint $table) {
            $table->id("id_saldo_kas");
            $table->date("tanggal");
            $table->float("total_saldo");
            $table->bigInteger("kas_jenis_id")->unsigned();
            $table->timestamps();

            $table->foreign('kas_jenis_id')->references('id_jenis_kas')->on("jenis_kas")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saldo_kas');
    }
}
