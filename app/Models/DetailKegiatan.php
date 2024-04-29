<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKegiatan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_detail_kegiatan';
    protected $fillable = ['tgl_kegiatan', 'nama_pengaju', 'deskripsi', 'pj_id', 'kegiatan_id'];
    protected $table = 'detail_kegiatans';

    public function penanggungJawab(){
        return $this->hasMany(PenanggungJawab::class);
    }
    public function kegiatan(){
        return $this->hasMany(Kegiatan::class);
    }
}
