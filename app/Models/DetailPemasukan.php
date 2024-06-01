<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPemasukan extends Model
{
    use HasFactory;

    protected $primaryKey = "id_detail";
    protected $fillable = ['nama_pemasukan', 'tgl_pemasukan', 'biaya_pemasukan', 'deskripsi'];

    public function saldoKas(){
        return $this->hasMany(Saldo_kas::class);
    }
}
