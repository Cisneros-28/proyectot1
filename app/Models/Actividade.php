<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividade extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'enlace','estado_acti', 'id_tema','id_user','id_curso'];

    public function tema(){
        return $this->belongsTo(Tema::class,'id_tema');
    }
    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
    public function curso(){
        return $this->belongsTo(Curso::class,'id_curso');
    }
}
