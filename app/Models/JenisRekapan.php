<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisRekapan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_jenis_rekapan';
    protected $fillable = ['nama_jenis_rekapan'];
}
