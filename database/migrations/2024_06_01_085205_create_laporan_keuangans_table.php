<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanKeuangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_keuangans', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->string('judul');
            $table->date('tanggal');
            $table->integer('saldo_masuk');
            $table->integer('saldo_keluar');
            $table->decimal('total_saldo', 15, 2);
            $table->text('deskripsi')->nullable();
            $table->boolean('persetujuan')->default(false);
            $table->text('catatan')->nullable();
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
        Schema::dropIfExists('laporan_keuangans');
    }
}
