<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YayasanPenerimaZakat extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_yayasan';
    protected $fillable = ['nama_yayasan', 'rekapan_beras', 'rekapan_uang', 'tanggal','gambar_surat'];

}
