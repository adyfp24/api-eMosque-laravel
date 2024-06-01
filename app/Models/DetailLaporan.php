<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailLaporan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_detail_laporan';
    protected $fillable = ['transaksi_id', 'laporan_id'];
}
