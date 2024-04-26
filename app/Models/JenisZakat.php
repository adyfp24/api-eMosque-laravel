<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisZakat extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_jenis_zakat';
    protected $fillable = ['nama_jenis_zakat'];

    public function zakatFitrah (){
        return $this->belongsTo(ZakatFitrah::class);
    }
}
