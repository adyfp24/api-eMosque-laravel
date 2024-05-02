<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perizinan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_perizinan';
    protected $fillable = ['nama_perizinan'];

    public function detailKegiatan(){
        return $this->belongsTo(DetailKegiatan::class);
    }
}
