<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examene extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'estado_eval', 'id_tema','id_trimestre','id_user','id_curso'];

    public function tema(){
        return $this->belongsTo(Tema::class,'id_tema');
    }
    public function pregunta(){
        return $this->hasMany(Pregunta::class, 'id');
    }
    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
    public function nota(){
        return $this->hasMany(Nota::class, 'id');
    }
    public function curso(){
        return $this->belongsTo(Curso::class,'id_curso');
    }
    public function trimestre(){
        return $this->belongsTo(Trimestre::class,'id_trimestre');
    }
}
