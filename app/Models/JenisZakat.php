<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisZakat extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_jenis_zakat';
    protected $fillable = ['nama_jenis_zakat'];
    protected $table = 'jenis_zakats';

    public function zakatFitrah (){
        return $this->belongsTo(ZakatFitrah::class);
    }
}
