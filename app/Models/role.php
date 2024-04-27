<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_role';
    protected $fillable = ['nama_role'];

    public function roles(){
        return $this->belongsTo(role::class);
    }
}
