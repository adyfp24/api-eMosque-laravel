<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kegiatan';
    protected $fillable = ['nama_kegiatan'];

    public function detailKegiatan(){
        return $this->belongsTo(DetailKegiatan::class);
    }
}
