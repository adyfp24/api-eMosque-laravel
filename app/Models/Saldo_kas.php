<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldo_kas extends Model
{
    use HasFactory;

    protected $primarykey = "id_saldo_kas";
    protected $fillable = ["tanggal", 'total_saldo'];

    public function jenisKas()
    {
        return $this->hasMany(Jenis_kas::class);
    }
}
