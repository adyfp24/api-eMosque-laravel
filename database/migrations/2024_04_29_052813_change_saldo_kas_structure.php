<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSaldoKasStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('saldo_kas', function (Blueprint $table) {
            // Menambah kolom saldo_masuk
            $table->float('saldo_masuk')->after('tanggal')->default(0);

            // Menambah kolom saldo_keluar
            $table->float('saldo_keluar')->after('saldo_masuk')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('saldo_kas', function (Blueprint $table) {
            // Menghapus kolom saldo_masuk
            $table->dropColumn('saldo_masuk');

            // Menghapus kolom saldo_keluar
            $table->dropColumn('saldo_keluar');
        });
    }
}
