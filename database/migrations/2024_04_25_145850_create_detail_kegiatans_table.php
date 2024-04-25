<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_kegiatans', function (Blueprint $table) {
            $table->id("id_detail_kegiatan");
            $table->date("tgl_kegiatan");
            $table->string("nama_pengaju");
            $table->text("deskripsi");
            $table->bigInteger("pj_id")->unsigned();
            $table->bigInteger("kegiatan_id")->unsigned();
            $table->bigInteger("perizinan_id")->unsigned();
            $table->timestamps();
            
            $table->foreign("pj_id")->references("id_pj")->on("penanggung_jawabs")->onDelete('cascade');
            $table->foreign("kegiatan_id")->references("id_kegiatan")->on("kegiatans")->onDelete('cascade');
            $table->foreign("perizinan_id")->references("id_perizinan")->on("perizinans")->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_kegiatans');
    }
}
