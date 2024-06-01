<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPemasukansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pemasukans', function (Blueprint $table) {
            $$table->id("id_detail");
            $table->string("nama_pemasukan");
            $table->date("tgl_pemasukan");
            $table->integer("biaya_pemasukan");
            $table->text("deskripsi");
            $table->bigInteger("kas_saldo_id")->unsigned();
            $table->timestamps();

            $table->foreign("kas_saldo_id")->references("id_saldo_kas")->on("saldo_kas")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pemasukans');
    }
}
