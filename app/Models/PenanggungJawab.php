<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenanggungJawab extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_penanggung_jawab';
    protected $fillable = ['nama_pj'];

    public function kegiatan(){
        return $this->belongsTo(Kegiatan::class);
    }
}
