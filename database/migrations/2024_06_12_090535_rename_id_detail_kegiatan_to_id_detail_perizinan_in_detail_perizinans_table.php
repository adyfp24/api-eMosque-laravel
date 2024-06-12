<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameIdDetailKegiatanToIdDetailPerizinanInDetailPerizinansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_perizinans', function (Blueprint $table) {
            $table->renameColumn('id_detail_kegiatan', 'id_detail_perizinan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('id_detail_perizinan_in_detail_perizinans', function (Blueprint $table) {
            //
        });
    }
}
