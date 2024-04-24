<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RekapanZakat extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_rekapan_zakat';
    protected $fillable = ['rekapan_total_uang','rekapan_total_beras','tgl_rekapan','jenis_rekapan_id','jenis_zakat_id','yayasan_id'];
    public function jenisRekapan(){
        return $this->hasMany(JenisRekapan::class);
    }
    public function jenisZakat(){
        return $this->hasMany(JenisZakat::class);
    }
    public function yayasanPenerimaZakat(){
        return $this->hasMany(YayasanPenerimaZakat::class);
    }
}
