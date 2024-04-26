<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZakatFitrah extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_zakatfotrah';
    protected $fillable = ['nama_pezakat' , 'jumlah_pezakat'];

    public function jenisZakat(){
        return $this->hasMany(JenisZakat::class);
    }
}
