<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qurban extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_qurban';
    protected $fillable = ['nama_orang_berqurban', 'tanggal', 'dokumentasi', 'deskripsi','qurban_jenis_id'];

    public function jenisQurban(){
        return $this->hasMany(JenisQurban::class);
    }
}
