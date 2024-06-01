<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;
    protected $fillable = ['nota_res', 'id_examen', 'id_user'];


    public function examen(){
        return $this->belongsTo(Examene::class,'id_examen');
    }
    public function usuar(){
        return $this->belongsTo(User::class,'id_user');
    }
}
