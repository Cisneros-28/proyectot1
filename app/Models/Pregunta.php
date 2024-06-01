<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;
    protected $fillable = ['detalle_pre', 'id_examen'];


    public function examen(){
        return $this->belongsTo(Examene::class,'id_examen');
    }
    public function respuesta(){
        return $this->hasMany(Respuesta::class, 'id');
    }
}
