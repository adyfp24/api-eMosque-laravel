<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPerizinan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_detail_perizinan';
    protected $fillable = ['tgl_kegiatan', 'nama_pengaju', 'deskripsi', 'pj_id', 'perizinan_id'];
    protected $table = 'detail_perizinans';

    public function penanggungJawab(){
        return $this->hasMany(PenanggungJawab::class);
    }
    public function perizinan(){
        return $this->hasMany(Perizinan::class);
    }
}
