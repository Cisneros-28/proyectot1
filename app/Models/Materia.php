<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
    protected $fillable = ['descripcion','estado_materia'];

    public function tema(){
        return $this->hasMany(Tema::class,'id');
    }
}
