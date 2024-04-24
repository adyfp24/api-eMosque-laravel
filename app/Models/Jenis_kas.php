<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis_kas extends Model
{
    use HasFactory;

    protected $primarykey = 'id_jenis_kas';
    protected $fillable = 'nama_jenis';

    public function saldoKas(){
        return $this->belongsTo(Saldo_kas::class);
    }
}
