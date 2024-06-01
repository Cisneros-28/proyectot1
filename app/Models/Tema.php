<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'detalle_tema', 'recurso','id_materia','id_bloque','id_user','estado_tema'];

    public function examen(){
        return $this->hasMany(Examene::class,'id');
    }
    public function bloquedetalle(){
        return $this->hasMany(DetalleBloque::class,'id');
    }
    public function materia(){
        return $this->belongsTo(Materia::class,'id_materia');
    }
    public function actividad(){
        return $this->hasMany(Actividade::class,'id');
    }
    public function bloque(){
        return $this->belongsTo(Bloque::class,'id_bloque');
    }
    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
}
