<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trimestre extends Model
{
    use HasFactory;

    protected $fillable = ['descripcion', 'estado_t'];

    public function examen(){
        return $this->hasMany(Examene::class,'id');
    }
}
