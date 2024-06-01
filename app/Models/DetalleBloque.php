<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleBloque extends Model
{
    use HasFactory;
    protected $fillable = ['titulo','descripcion','archivo','imagen','video','id_tema','id_bloque','id_user','id_curso','id_recurso','estado'];



    public function comentario(){
        return $this->hasMany(Comentario::class,'id');
    }
    public function actividad(){
        return $this->hasMany(Actividade::class,'id');
    }
    public function asistencia(){
        return $this->hasMany(Asistencia::class,'id');
    }
    public function tema(){
        return $this->belongsTo(Tema::class,'id_tema');
    }
    public function bloque(){
        return $this->belongsTo(Bloque::class,'id_bloque');
    }
    public function type(){
        return $this->belongsTo(Recurso::class,'id_recurso');
    }
    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
    public function curso(){
        return $this->belongsTo(Curso::class,'id_curso');
    }
}
