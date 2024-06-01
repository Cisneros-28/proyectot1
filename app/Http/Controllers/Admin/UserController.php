<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Curso;


class UserController extends Controller
{
    use HasRoles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // es para bloquear la ruta
   // public function __construct()
   // {
    //    $this->middleware('can:admin.usuario.index')->only('index');
   //     $this->middleware('can:admin.usuario.edit')->only('edit','update');
  //  }
    public function index()
    {

        $usuarios = User::with('roles')->join("roles", "roles.id", "=", "users.id_rol")
        ->select('users.nombre_user','users.id','users.apellido_user','users.estado_user',
        'users.direccion','roles.name','users.genero')
        ->whereIn("roles.name",['director','secretaria'])
        ->get();
      // return view('admin.users.index',compact('users'));
       return view('admin.usuarios.index',compact('usuarios'));

    }


    public function edit(User $user,$id)
    {
        $users = User::findOrFail($id);
        $options = Role::where('estado_rol','=',1)->whereIn('name',['DIRECTOR','SECRETARIA'])->pluck('name','id')->toArray();
        $roles = [ null => "SELECCIONE ROL"] + $options;
        // $position = Position::where('estado_rol','=',1)

        // ->pluck('nombre_rol','id');
        $cursos= Curso::where('estado_curso','=',1)->where('nombre_curso','TODOS')->get()->pluck('id');

      // return view('admin.users.edit',compact('user','roles'));
       return view('admin.usuarios.edit',compact('users','roles','cursos'));

    }

    public function update(Request $request, User $user,$id)
    {
        $request->validate(
            [
                  'nombre_user' => 'required',
                 'apellido_user' => 'required',
                  'genero' => 'required',
                  'direccion' => 'required',
                  'email' => 'required',
                  'password' => 'required',
                  'estado_user' => 'required',
                  'roles' => 'required',
                  'genero' => 'required',

              ]
         );
         $prueba = Role::find($request->roles);


        $user = User::find($id);
        $user->nombre_user = strtoupper($request->nombre_user);
        $user->apellido_user =strtoupper($request->apellido_user);
        $user->genero=$request->genero;
        $user->direccion =strtoupper( $request->direccion);
        $user->email = $request->email;
        $user->estado_user=$request->estado_user;

        $user->password=Hash::make($request->password);
         $user->id_rol = $prueba->id;
        $user->id_curso=$request->id_curso;

        $user ->save();

        $user->roles()->sync($request->roles);
      //  return redirect()->route('admin.users.edit',$user)->with('mensaje','Se asigno los roles');
        return redirect()->route('admin.usuarios.index')->with('mensaje','Actualizo el Usuario');

    }

    public function create()
    {
        $options = Role::where('estado_rol','=',1)->whereIn('name',['DIRECTOR','SECRETARIA'])->pluck('name','id')->toArray();
        $roles = [ null => "SELECCIONE ROL"] + $options;

        //$position = Position::where('estado_rol','=',1)->whereIn('nombre_rol',['DIRECTOR','SECRETARIA'])->pluck('nombre_rol','id','estado_rol');
        $cursos= Curso::where('estado_curso','=',1)->where('nombre_curso','TODOS')->get()->pluck('id');

        return view('admin.usuarioS.create',compact('roles','cursos'));

    }

    public function store(Request $request)

    {
        $request->validate(
            [
                  'nombre_user' => 'required',
                 'apellido_user' => 'required',
                  'genero' => 'required',
                  'direccion' => 'required',
                  'email' => 'required',
                  'password' => 'required',
                  'estado_user' => 'required',
                  'id_curso'=>'required',
                  'roles' => 'required',
                  'genero' => 'required',

              ]
         );

         $prueba = Role::find($request->roles);

        $user = new User();
        $user->nombre_user = strtoupper($request->nombre_user);
        $user->apellido_user =strtoupper($request->apellido_user);
        $user->genero=$request->genero;
        $user->direccion =strtoupper( $request->direccion);
        $user->email = $request->email;
        $user->estado_user=$request->estado_user;

        $user->password=Hash::make($request->password);
        $user->id_rol = $prueba->id;

        $user->id_curso=$request->id_curso;
        $user ->save();

        $user->roles()->sync($request->roles);

        return redirect()->route('admin.usuarios.index')->with('mensaje','Usuario Guardado');

    }

    public function show($id)
    {
        //
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user-> delete();
        return redirect()->route('admin.usuarios.index')->with('mensaje','Usuario eliminado');
    }
}
