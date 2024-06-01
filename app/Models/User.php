<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function adminlte_image()
    {
        //SE PUEDE LLAMAR DE LA BASE DE DATOS
     //   return URL::asset('imagen/taratara.jpg');
        //ALEATORIO
      return 'https://picsum.photos/300/300';
    }




    public function adminlte_desc(){
        //return $this->role_id;
       // return 'Estudiante';
$nombre = Auth::user()->nombre_user;
$apellido =  Auth::user()->apellido_user;
       return   $nombre." ".$apellido;
    }
    public function adminlte_profile_url()
{//editar perfil
    return 'admin/cursos';
}

public function rol(){
    return $this->belongsTo(Role::class,'id_rol');
}
public function curso(){
    return $this->belongsTo(Curso::class,'id_curso');
}
public function respuesta(){
  return $this->hasMany(Respuesta::class);
}
public function examen(){
    return $this->hasMany(Examene::class);
}

public function asistencias(){
    return $this->belongsTo(Asistencia::class);
}

public function asistenciaDetalle(){
    return $this->belongsTo(AsistenciaDetalle::class);
}

public function nota(){
    return $this->hasMany(Nota::class, 'id');
}
public function actividad(){
    return $this->hasMany(Actividade::class,'id');
}
public function comentarios(){
    return $this->hasMany(Comentario::class,'id');
}
public function tema(){
    return $this->hasMany(Tema::class,'id');
}

public function materia(){
    return $this->hasMany(Materia::class,'id');
}
}
