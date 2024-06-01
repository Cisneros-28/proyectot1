<?php

namespace App\Http\Controllers\Profesor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nota;
use App\Models\Trimestre;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PDF;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        //$estudiantes = Username::all();

        $estudiantes = User::with('roles')->join("roles", "roles.id", "=", "users.id_rol")->
        with('curso')->join('cursos','cursos.id','=','users.id_curso')

            ->select("users.nombre_user", "users.apellido_user", 'users.id', 'roles.name', 'users.estado_user', 'users.id_curso')
            ->where("roles.name", "=", 'ESTUDIANTE')
            ->where('users.id_curso','=',Auth::user()->curso->id)
            ->get();
        return view('profesor.estudiantes.index', compact('estudiantes',));
    }
    public function show($id)
    {

        $estudiantes = User::with('asistenciaDetalle')->join("asistencia_detalles", "asistencia_detalles.user_id", "=", "users.id")
            ->select("asistencia_detalles.id", "asistencia_detalles.estado", 'asistencia_detalles.fecha','asistencia_detalles.verificar')
            ->where("asistencia_detalles.user_id", "=", $id)
            ->get();
        $count = count($estudiantes);
        if ($count > 0) {
            $estudiantes = User::with('asistenciaDetalle')->join("asistencia_detalles", "asistencia_detalles.user_id", "=", "users.id")
                ->select("asistencia_detalles.id", "asistencia_detalles.estado", 'asistencia_detalles.fecha','asistencia_detalles.verificar')
                ->where("asistencia_detalles.user_id", "=", $id)
                ->get();

            $count = count($estudiantes);
            $user = User::findOrFail($id);

            return view('profesor.estudiantes.show', compact('estudiantes', 'user', 'count'));

        } else {
            $estudiantes = User::with('asistenciaDetalle')->join("asistencia_detalles", "asistencia_detalles.user_id", "=", "users.id")
                ->select("asistencia_detalles.id", "asistencia_detalles.estado", 'asistencia_detalles.fecha','asistencia_detalles.verificar')
                ->where("asistencia_detalles.user_id", "=", $id)
                ->get();
            $user = User::findOrFail($id);

            return view('profesor.estudiantes.show', compact('estudiantes', 'user', 'count'));
        }
    }



    public function notas($id)
    {
        //$evaluacion=Evaluate::all();
        $estudiantes = Nota::with('usuar')->join("users", "notas.id_user", "=", "users.id")->
        with('examen')->join("examenes", "notas.id_examen", "=", "examenes.id")
            ->where("users.id", "=", $id)
            ->select('notas.nota_res', 'examenes.nombre')->get();
        $count = count($estudiantes);
        $user = User::findOrFail($id);
        if ($count > 0) {

$trimestre= Trimestre::get();
            $estudiantes = Nota::with('usuar')->join("users", "notas.id_user", "=", "users.id")
           ->with('examen')->join("examenes", "notas.id_examen", "=", "examenes.id")
               ->join('trimestres','examenes.id_trimestre','=','trimestres.id')
                ->where("users.id", "=", $id)
                ->select('notas.nota_res', 'examenes.nombre','examenes.id_trimestre','trimestres.descripcion')->get();
            $count = count($estudiantes);

            $user = User::findOrFail($id);

            return view('profesor.estudiantes.notas', compact('estudiantes', 'user', 'count','trimestre'));

        } else {
            $trimestre= Trimestre::get();
            $estudiantes = Nota::join("users", "notas.id_user", "=", "users.id")
                ->join("examenes", "notas.id_examen", "=", "examenes.id")
                ->where("users.id", "=", $id)
                ->select('notas.nota_res', 'examenes.nombre')->get();
            $user = User::findOrFail($id);

            return view('profesor.estudiantes.notas', compact('estudiantes', 'user', 'count','trimestre'));
        }
    }



    public function pdf($id)
    {

        $usuario = Nota::join("users", "notas.id_user", "=", "users.id")
            ->join("examenes", "notas.id_examen", "=", "examenes.id")
            ->where("users.id", "=", $id)
            ->select('notas.nota_res', 'examenes.nombre', 'examenes.id','examenes.id_trimestre')->get();
        $count = count($usuario);
        $user = User::where('id', $id)->get()->unique();
/*
$pdf = App::make('dompdf.wrapper');
$pdf->loadHTML('<h1>Test</h1>');
return $pdf->stream();*/

        $pdf = PDF::loadView('profesor.reportes.index', ['usuario' => $usuario, 'user' => $user, 'count' => $count]);
        //$pdf->loadHTML('<h1>Test</h1>');
        //return $pdf->download('documento.pdf');
        return $pdf->stream();
    }

    public function asistencia($id)
    {
        $estudiantes = User::join("asistencia_detalles", "asistencia_detalles.user_id", "=", "users.id")
            ->select("asistencia_detalles.id", "asistencia_detalles.estado", 'asistencia_detalles.fecha','asistencia_detalles.verificar')
            ->where("asistencia_detalles.user_id", "=", $id)
            ->get();
        $count = count($estudiantes);
        $user = User::where('id', $id)->get()->unique();
        $pdf = PDF::loadView('profesor.reportes.asistencia', ['estudiantes' => $estudiantes, 'user' => $user, 'count' => $count]);

        return $pdf->stream();
    }
}
