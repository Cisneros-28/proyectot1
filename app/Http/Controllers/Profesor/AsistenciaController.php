<?php

namespace App\Http\Controllers\Profesor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Asistencia;
use App\Models\AsistenciaDetalle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class AsistenciaController extends Controller
{
    use HasRoles;
    public function index()
    {
        //
        $asistencias = Asistencia::with('user')->join('users', 'users.id', '=', 'asistencias.user_id')
            ->join('cursos', 'cursos.id', '=', 'users.id_curso')
            ->where('users.id_curso', '=', Auth::user()->curso->id)
            ->select('asistencias.fecha', 'asistencias.id', 'asistencias.estado', 'asistencias.user_id')->get();

        return view('profesor.asistencias.index', compact('asistencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hoy = date('Y-m-d');
        //return $hoy;
        $asistencia = Asistencia::where('estado', 'p')->where('fecha', $hoy)->where('user_id', Auth::user()->id)->get()->first();
        // return $asistencia;
        if (!$asistencia) {
            if (Auth::user()->rol->name == 'PROFESOR' ) {  // Auth::user()->rol_id ==1 para registrar solo asistencia comparando el rol de la persona


                $asistencia = new Asistencia();
                $asistencia->fecha = date('Y-m-d');
                $asistencia->estado = 'P';
                $asistencia->user_id = Auth::user()->id;
                $asistencia->save();
            }
            $id = Asistencia::where('fecha', $hoy)->where('user_id', Auth::user()->id)->latest('id')->first();
            //modificar el id por el nombre 'estudiante' IMPLEMETNAR ->where('curso_id',1)
            $estudiantes = User::join("roles", "roles.id", "=", "users.id_rol")
                ->join('cursos', 'cursos.id', '=', 'users.id_curso')
                ->select("users.nombre_user", "users.apellido_user", 'users.id', "users.direccion", 'users.estado_user', 'users.genero', 'users.email', 'users.id_curso')
                ->where("roles.name", "=", 'ESTUDIANTE')
                ->where('users.id_curso', '=', Auth::user()->curso->id)
                ->get();
            //$estudiantes= User::where('id_rol', 1)->get();
            $con = count($estudiantes);

            for ($i = 0; $i < $con; $i++) {
                $detalle = new AsistenciaDetalle();
                $detalle->estado = 'ausente';
                $detalle->fecha = $id->fecha;
                $detalle->user_id = $estudiantes[$i]->id;
                $detalle->asistencia_id = $id->id;
                $detalle->verificar = 0;
                $detalle->save();
            }
        }


        return back();


        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $asistencia = Asistencia::find($id);
        $detalle = AsistenciaDetalle::where('asistencia_id', $id)->get();
        return view('profesor.asistencias.show', compact('asistencia', 'detalle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {
        $asistencia = Asistencia::find($id);
        return view('profesor.asistencias.edit', compact('asistencia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {



        foreach ($request->verificar as $key => $verificar) {

            $tema = AsistenciaDetalle::find($request->verificar[$key]);

            if ($tema->verificar == 0)

                $tema->verificar = 1;
            else
                $tema->verificar = 0;

            $tema->save();
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $AsistenciaDetalle = AsistenciaDetalle::where('asistencia_id', $id);
        $AsistenciaDetalle->delete();
        $asistencia = Asistencia::where('id', $id);
        $asistencia->delete();

        return redirect()->route('profesor.asistencias.index');
    }
}
