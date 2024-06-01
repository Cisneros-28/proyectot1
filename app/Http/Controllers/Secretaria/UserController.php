<?php

namespace App\Http\Controllers\Secretaria;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use HasRoles;

    public function index(){
        //$estudiantes = Username::all();

        $estudiantes = User::with('roles')->with('curso')->join("roles", "roles.id", "=", "users.id_rol")
->select("users.nombre_user", "users.apellido_user", 'users.id',"users.direccion",'roles.name','users.estado_user','users.genero','users.email','users.id_curso')
->where("roles.name", "=", 'ESTUDIANTE')
->get();
        return view('secretaria.estudiantes.index', compact('estudiantes'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { //abrir formulario para un nuevo registro
        $options1 = Role::where('estado_rol','=',1)->where('name', 'ESTUDIANTE')->pluck('name','id')->toArray();
        $roles = [ null => "SELECCIONE ROL"] + $options1;

       $options2 = Curso::where('estado_curso', '=', 1)->where('nombre_curso','!=','TODOS')->pluck('nombre_curso', 'id')->toArray();
       $cursos = [ null => "SELECCIONE CURSO"] + $options2;

       return view('secretaria.estudiantes.create', compact('roles','cursos'));
    }

    public function store(Request $request)
    { //guardar BD los Registro

        $request->validate(
            [
                  'nombre_user' => 'required',
                 'apellido_user' => 'required',
                  'genero' => 'required',
                  'direccion' => 'required',
                  'email' => 'required|unique:users,email',
                'password' => 'required',
                'genero' => 'required',
                'roles' => 'required',
                'id_curso' => 'required',
                'estado_user' => 'required',
              ]
         );
         $prueba = Role::find($request->roles);

        $estudiante = new User();
        $estudiante->nombre_user = strtoupper($request->nombre_user);
        $estudiante->apellido_user =strtoupper($request->apellido_user);
        $estudiante->genero=$request->genero;
        $estudiante->direccion =strtoupper($request->direccion);
        $estudiante->email = $request->email;
        $estudiante->estado_user=$request->estado_user;

        $estudiante->password=Hash::make($request->password);
        $estudiante->id_rol = $prueba->id;
        $estudiante->id_curso =$request->id_curso;

        $estudiante->save();
        $estudiante->roles()->sync($request->roles);

        return redirect()->route('secretaria.estudiantes.index')->with('mensaje', 'Estudiante Guardada');
    }

    public function edit($id)
    { // Abrir un formualrio para Edicion de un registro BD
        //MEJORARLO
         $options1 = Role::where('estado_rol','=',1)->where('name', 'ESTUDIANTE')->pluck('name','id')->toArray();
         $roles = [ null => "SELECCIONE ROL"] + $options1;

         $estudiante = User::findOrFail($id);

 $options2 = Curso::where('estado_curso', '=', 1)->where('nombre_curso','!=','TODOS')->pluck('nombre_curso', 'id')->toArray();
 $cursos = [ null => "SELECCIONE CURSO"] + $options2;

 return view('secretaria.estudiantes.edit', compact('estudiante', 'roles','cursos'));
    }
    public function update(Request $request, $id)
    { //Actualizar el regsitro en el BD
//dd($request);
        $request->validate(
          [
                'nombre_user' => 'required',
               'apellido_user' => 'required',
                'genero' => 'required',
                'direccion' => 'required',
                'email' => 'required',
                'password' => 'required',
                'genero' => 'required',
                'roles' => 'required',
                'id_curso' => 'required',
                'estado_user' => 'required',
            ]
       );
       $prueba = Role::find($request->roles);

       $estudiante = User::findOrFail($id);
       $estudiante->nombre_user=strtoupper($request->input('nombre_user'));
      $estudiante->apellido_user=strtoupper($request->input('apellido_user'));
      $estudiante->genero=$request->input('genero');
      $estudiante->direccion=strtoupper($request->input('direccion'));
      $estudiante->email=$request->input('email');
      $estudiante->password=Hash::make($request->input('password'));
      $estudiante->estado_user=$request->input('estado_user');
      $estudiante->id_rol = $prueba->id;
      $estudiante->id_curso=$request->input('id_curso');

       $estudiante->save();

       $estudiante->roles()->sync($request->roles);

        return redirect()->route('secretaria.estudiantes.index')->with('mensaje','Estudiante Actualizado');
    }

    public function destroy($id)
    {
        // Eliminar un registro BD
        $estudiante= User::findOrFail($id);
        $estudiante->delete();
        return redirect()->route('secretaria.estudiantes.index')->with('deleted', 'Estudiante Eliminado');
    }

}
