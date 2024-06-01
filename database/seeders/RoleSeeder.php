<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      //crea el rol de manera manuaal
      $role1 = Role::create(['name'=>'ADMIN','estado_rol'=>1]);
      $role2 = Role::create(['name'=>'DIRECTOR','estado_rol'=>1]);

      $role3 = Role::create(['name'=>'PROFESOR','estado_rol'=>1]);
      $role4 = Role::create(['name'=>'SECRETARIA','estado_rol'=>1]);
      $role5 = Role::create(['name'=>'ESTUDIANTE','estado_rol'=>1]);


      //en esta parte asigna el permiso

///administrador

          Permission::create(['name'=> 'admin.permisos.index',
         'description' => 'Listado de Roles y Permisos vista Admin'])->syncRoles([$role1]);
          Permission::create(['name'=>'admin.cursos.index',
           'description'=> 'Listado de Cursos vista Admin'])->syncRoles([$role1]);

           Permission::create(['name'=>'admin.materias.index',
           'description'=> 'Listado de Materias vista Admin'])->syncRoles([$role1]);

        //    Permission::create(['name'=>'admin.roles.index',
        //    'description'=> 'Listado de roles '])->syncRoles([$role1]);

           Permission::create(['name'=>'admin.usuarios.index',
           'description'=> 'Listado de Usuarios vista Admin'])->syncRoles([$role1]);



           Permission::create(['name'=>'director.profesores.index',
           'description'=> 'Listado de Profesores vista Director'])->syncRoles([$role1]);



Permission::create(['name'=>'secretaria.estudiantes.index',
'description'=> 'Listado de estudiantes vista Secretaria'])->syncRoles([$role1]);


///estudiante

           Permission::create(['name'=>'estudiante.asistencias.index',
           'description'=> 'Asistencias vista Alumno'])->syncRoles([$role5]);



           Permission::create(['name'=>'estudiante.respuesta.index',
           'description'=> 'Dashboard vista Estudiante '])->syncRoles([$role5]);

///profesor

Permission::create(['name'=>'profesor.actividades.index',
'description'=> 'Listado de actividades vista Profesor '])->syncRoles([$role3]);

Permission::create(['name'=>'profesor.asistencias.index',
'description'=> 'Listado de Asistencias vista Profesor'])->syncRoles([$role3]);

Permission::create(['name'=>'profesor.bloques.index',
'description'=> 'Listado de Recursos de Bloques vista Profesor'])->syncRoles([$role3]);



Permission::create(['name'=>'profesor.dash.index',
'description'=> 'Dasboard vista Profesor '])->syncRoles([$role3]);

Permission::create(['name'=>'profesor.estudiantes.index',
'description'=> 'Listado de estudiantes vista Profesor'])->syncRoles([$role3]);

Permission::create(['name'=>'profesor.evaluaciones.index',
'description'=> 'Listado de evaluaciones vista profesor'])->syncRoles([$role3]);

Permission::create(['name'=>'profesor.preguntes.index',
'description'=> 'Listado de preguntas vista Profesor'])->syncRoles([$role3]);

Permission::create(['name'=>'profesor.reportes.index',
'description'=> 'Listado de reportes vista Profesor '])->syncRoles([$role3]);

Permission::create(['name'=>'profesor.temas.index',
'description'=> 'Listado de temas vista Profesor '])->syncRoles([$role3]);




//-------------

    //    Permission::create(['name'=>'examenes.index',
    //        'description'=> 'ver listado de examenes '])->syncRoles([$role1]);

    //        Permission::create(['name'=>'admin.usuarios.index',
    //        'description'=> 'ver listado de usuarios '])->syncRoles([$role1]);

    //        Permission::create(['name'=>'asistencias.index',
    //        'description'=> 'ver listado de asistencias '])->syncRoles([$role1]);


    User::create([
        'nombre_user' => 'Admin',
        'apellido_user' => 'Admin',
         'genero' => 'M',
        'direccion' =>'Indefinido',
         'email' =>'admin@gmail.com',
         'password' => bcrypt('123'),
       'estado_user' => '1',
         'id_rol' => 1,
         'id_curso' => 1
    ])->assignRole('ADMIN');


    User::create([
        'nombre_user' => 'profesor',
        'apellido_user' => 'profesor',
         'genero' => 'M',
        'direccion' =>'Indefinido',
         'email' =>'profesor@gmail.com',
         'password' => bcrypt('123'),
       'estado_user' => '1',
         'id_rol' => 3,
         'id_curso' => 2
    ])->assignRole('PROFESOR');

    User::create([
        'nombre_user' => 'Estudiante1',
        'apellido_user' => 'Estudiante1',
         'genero' => 'M',
        'direccion' =>'Indefinido',
         'email' =>'estudiante@gmail.com',
         'password' => bcrypt('123'),
       'estado_user' => '1',
         'id_rol' => 5,
         'id_curso' => 2
    ])->assignRole('ESTUDIANTE');
    }
}
