<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKeuangan extends Model
{
    use HasFactory;
    protected $table = 'laporan_keuangans';

    protected $primaryKey = 'id_laporan';

    protected $fillable = ['judul', 'saldo_masuk', 'saldo_keluar', 'tanggal', 'total_saldo', 'deskripsi', 'persetujuan' , 'catatan'];

}

