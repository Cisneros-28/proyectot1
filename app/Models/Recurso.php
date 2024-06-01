<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','estado'];

    public function detalle_bloque(){
     return $this->hasMany(DetalleBloque::class,'id');
   }
}
