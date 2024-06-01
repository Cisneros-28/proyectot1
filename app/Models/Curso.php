<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_curso', 'estado_curso'];

    public function user(){
        return $this->hasMany(User::class,'id');
    }
    public function actividad(){
        return $this->hasMany(Actividade::class,'id');
    }
    public function examen(){
        return $this->hasMany(Examene::class,'id');
    }
}
