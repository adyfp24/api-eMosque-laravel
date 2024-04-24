<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kegiatan';
    protected $fillable = ['nama_kegiatan', 'detail_kegiatan_id', 'perizinan_id', 'penanggung_jawab_id'];

    public function detailKegiatan(){
        return $this->hasMany(DetailKegiatan::class);
    }

    public function penanggungJawab(){
        return $this->hasMany(PenanggungJawab::class);
    }

    public function perizinan(){
        return $this->hasMany(Perizinan::class);
    }
}
