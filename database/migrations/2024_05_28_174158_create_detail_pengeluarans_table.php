<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPengeluaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pengeluarans', function (Blueprint $table) {
            $table->id("id_detail");
            $table->string("nama_pengeluaran");
            $table->date("tgl_pemasukan");
            $table->integer("biaya_pengeluaran");
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
        Schema::dropIfExists('detail_pengeluarans');
    }
}
