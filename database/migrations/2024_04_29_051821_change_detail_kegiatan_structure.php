<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDetailKegiatanStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_kegiatans', function (Blueprint $table) {
            $table->dropForeign(['perizinan_id']);
        
        
            $table->dropIndex('detail_kegiatans_perizinan_id_foreign');
            
            $table->dropColumn('perizinan_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_kegiatans', function (Blueprint $table) {
            // Jika Anda ingin membuat rollback, Anda dapat menambahkan kembali kolom perizinan_id
            $table->bigInteger("perizinan_id")->unsigned()->after('kegiatan_id');
            $table->foreign("perizinan_id")->references("id_perizinan")->on("perizinans")->onDelete('cascade');
        });
    }
}
