<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;

    protected $fillable = ['respuesta', 'eval', 'id_pregunta','id_user'];//id_user


    public function pregunta(){
        return $this->belongsTo(Pregunta::class,'id_pregunta');
    }

    public function user(){
      return $this->belongsTo(User::class,'id_user');
  }

}
