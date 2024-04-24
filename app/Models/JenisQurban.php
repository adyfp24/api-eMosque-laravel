<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisQurban extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_jenis_qurban';
    protected $fillable = 'nama_jenis';

    public function qurban(){
        return $this->belongsTo(Qurban::class);
    }
}
