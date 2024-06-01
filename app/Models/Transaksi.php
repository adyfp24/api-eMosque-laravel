<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_transaksi';

    protected $fillable = ['judul', 'nominal', 'jenis', 'tanggal', 'deskripsi'];

    public function detailLaporan(){
        return $this->belongsTo();
    }
}
