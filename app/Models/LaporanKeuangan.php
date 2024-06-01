<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKeuangan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_laporan';

    protected $fillable = ['tgl_awal', 'tgl_akhir', 'total_pemasukan', 'total_pengeluaran', 'total_saldo', 'persetujuan'];

    public function detailLaporan(){
        return $this->belongsTo(LaporanKeuangan::class);
    }
}
