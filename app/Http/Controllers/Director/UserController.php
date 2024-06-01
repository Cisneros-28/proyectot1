<?php

namespace App\Http\Controllers\Director;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    use HasRoles;
    public function index()
    {
        // $roles = Role::all();
        $profesores = User::with('roles')->with('curso')->join("roles", "roles.id", "=", "users.id_rol")
            ->select("users.nombre_user", "users.apellido_user", 'users.id', "users.direccion", 'roles.name', 'users.estado_user', 'users.genero', 'users.id_curso')
            ->where("roles.name", "=", 'PROFESOR')
            ->get();
        return view('director.profesores.index', compact('profesores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { //abrir formulario para un nuevo registro
        $options = Role::where('estado_rol', '=', 1)->where('name', 'PROFESOR')->pluck('name', 'id', 'estado_rol')->toArray();
        $roles = [ null => "SELECCIONE ROL"] + $options;
        $options2 = Curso::where('estado_curso', '=', 1)->where('nombre_curso','!=','TODOS')->pluck('nombre_curso', 'id')->toArray();
        $cursos = [ null => "SELECCIONE CURSO"] + $options2;

        return view('director.profesores.create', compact('roles', 'cursos'));
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

        return redirect()->route('director.profesores.index')->with('mensaje', 'Profesor Guardado');
    }

   public function edit($id)
    { // Abrir un formualrio para Edicion de un registro BD
        //MEJORARLO
        if (Auth::user()) {
        $options1 = Role::where('name', 'PROFESOR')->pluck('name', 'id')->toArray();;
        $roles = [null => "SELECCIONE ROL"] + $options1;

        $options2 = Curso::pluck('nombre_curso', 'id')->toArray();;
        $cursos = [null => "SELECCIONE CURSO"] + $options2;

        $profesor = User::findOrFail($id);

        return view('director.profesores.edit', compact('profesor', 'roles', 'cursos'));
    } else {
        Auth::logout();
        return redirect()->back();
    }
    }

    public function update(Request $request, $id)
    { //Actualizar el regsitro en el BD
        //dd($request);
        if (Auth::user()) {
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

        $profesor = User::findOrFail($id);
        $profesor->nombre_user = strtoupper($request->input('nombre_user'));
        $profesor->apellido_user = strtoupper($request->input('apellido_user'));
        $profesor->genero = $request->input('genero');
        $profesor->direccion = strtoupper($request->input('direccion'));
        $profesor->email = $request->input('email');
        $profesor->password = Hash::make($request->input('password'));
        //$usuario->password = Hash::make($request->password);
        $profesor->estado_user = $request->input('estado_user');
        $profesor->id_rol = $prueba->id;
        $profesor->id_curso = $request->input('id_curso');
        $profesor->update();
        $profesor->roles()->sync($request->roles);

        return redirect()->route('director.profesores.index')->with('actualizar', 'ok');
    } else {
        Auth::logout();
        return redirect()->back();
    }
    }




    public function destroy($id)
    {
        // Eliminar un registro BD
        $profesor = User::findOrFail($id);
        $profesor->delete();
        return redirect()->route('director.profesores.index')->with('deleted', 'Profesor Eliminado');
    }
}
