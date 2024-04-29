<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZakatFitrah extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_zakatfitrah';
    protected $fillable = ['nama_pezakat' , 'jumlah_zakat', 'zakat_jenis_id'];

    public function jenisZakat(){
        return $this->hasMany(JenisZakat::class);
    }
}
