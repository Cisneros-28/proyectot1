<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bloque extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','estado_b'];

    public function bloquedetalle(){
        return $this->hasMany(DetalleBloque::class,'id');
    }

    public function actividad(){
        return $this->hasMany(Actividade::class,'id');
    }
    public function examen(){
        return $this->hasMany(Examene::class,'id');
    }
    public function tema(){
        return $this->hasMany(Tema::class,'id');
    }
}
