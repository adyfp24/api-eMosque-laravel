<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengeluaran extends Model
{
    use HasFactory;

    protected $primaryKey = "id_detail";
    protected $fillable = ['nama_pengeluaran', 'tgl_pengeluaran', 'biaya_pengeluaran', 'deskripsi'];

    public function saldoKas(){
        return $this->hasMany(Saldo_kas::class);
    }
}
