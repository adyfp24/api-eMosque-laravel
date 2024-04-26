<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapanQurban extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_rekapan_qurban';
    protected $fillable = ['rekapan_total_daging_kambing', 'rekapan_total_daging_sapi', 'tgl_rekapan'];

    public function jeniRekapan(){
    return $this->hasMany(JenisRekapan::class);
    }
}
