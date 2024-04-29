<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenanggungJawab extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pj';
    protected $fillable = ['nama_pj'];

    public function detailKegiatan(){
        return $this->belongsTo(DetailKegiatan::class);
    }
}
