<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YayasanPenerimaQurban extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_yayasan';
    protected $fillable = ['nama_yayasan', 'rekapan_sapi', 'rekapan_kambing', 'tanggal','gambar_surat'];  
}
