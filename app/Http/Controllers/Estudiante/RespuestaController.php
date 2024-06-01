<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use App\Models\Actividade;
use App\Models\Asistencia;
use App\Models\AsistenciaDetalle;
use App\Models\DetalleBloque;
use App\Models\Examene;
use App\Models\Pregunta;
use App\Models\Respuesta;
use App\Models\Table;
use App\Models\Tema;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RespuestaController extends Controller
{
    public function index()
    {
        $user = User::with('roles')->join('roles', 'users.id_rol', '=', 'roles.id')->where('users.id_curso', Auth::user()->curso->id)->where('roles.name', '=', 'PROFESOR')->select('users.nombre_user', 'users.apellido_user', 'users.email')->get();
        $asistencia = Asistencia::with('user')->count();
        $count = Table::where('user', Auth::user()->id)->count();
        $verificar = AsistenciaDetalle::where('user_id',Auth::user()->id)->select('fecha','verificar')->get();
       /////////// dd($verificar);

//dd($verificar);
        if ($count > 0) {
            // $asistencia = Asistencia::with('user')->count();
            $bloques = DetalleBloque::with('tema')->with('type')->with('bloque')->get();
            $actividades = Actividade::with('tema')->where('id_curso', '=', Auth::user()->curso->id)->orderBy('id', 'asc')->paginate(10);
            $temas = Tema::with('bloque')->where('curso', '=', Auth::user()->curso->id)->orderBy('id', 'asc')->paginate(10);
            $evaluaciones = Examene::with('tema')->where('id_curso', '=', Auth::user()->curso->id)->orderBy('id', 'asc')->paginate(10);

            $respu = Table::whereNotNull('id')->where('user', Auth::user()->id)->get()->pluck('eval')->unique()->toArray();
            //contiene un array[1.2] con evaluacion 1 y evaluacion 2
            //dd($respu);

            $tamaño = count($respu);

            return view('estudiante.respuesta.index', compact('evaluaciones', 'temas', 'respu', 'count', 'tamaño', 'actividades', 'bloques', 'user', 'asistencia','verificar'));
        } else {
            $evaluaciones = Examene::with('tema')->where('id_curso', '=', Auth::user()->curso->id)->orderBy('id', 'asc')->paginate(10);
            $temas = Tema::with('bloque')->where('curso', '=', Auth::user()->curso->id)->orderBy('id', 'asc')->paginate(10);
            $actividades = Actividade::with('tema')->where('id_curso', '=', Auth::user()->curso->id)->orderBy('id', 'asc')->paginate(10);
            $bloques = DetalleBloque::with('tema')->with('type')->with('bloque')->get();


            return view('estudiante.respuesta.index', compact('evaluaciones', 'temas', 'count', 'actividades', 'bloques', 'user', 'asistencia','verificar'));
        }
    }


// inicio show
    public function show($evaluacion)
    { // visualizar un solo registro de BD

        $usuario = User::where('id', Auth::user()->id)->pluck('id');
        $eval = Examene::findOrFail($evaluacion);

        $preguntas = Pregunta::where('id_examen', $evaluacion)->get();
        $count = count($preguntas);


        return view('estudiante.respuesta.show', compact('preguntas', 'evaluacion', 'usuario', 'count', 'eval'));
    }


// inicio store
    public function store(Request $request)
    { //guardar BD los Registro

        $this->validate($request, [
                'id_user.*' => 'required',
            ]);

        foreach ($request->respuesta as $key => $respuesta) {

            $respuestas = new Respuesta();
            $respuestas->respuesta = $respuesta;
            $respuestas->id_pregunta = $request->id_pregunta[$key];
            $respuestas->eval = $request->eval[$key];
            $respuestas->id_user = $request->id_user[$key];

            $respuestas->save();
        }

        //inicio table
 $evaluacion = array_unique($request->eval);

        foreach ($evaluacion as $key => $evaluacion) {

            $guardar = new Table();
            $guardar->user =  Auth::user()->id;
            $guardar->eval = $evaluacion;
            $guardar->estado = 0;
            $guardar->save();
        }
        // fin table

        return redirect()->route('estudiante.respuesta.index')->with('mensaje', 'Evaluacion Enviada Guardada');;
    }


// inicio download
    public function download($id)
    {
        $doc = Tema::where('id', $id)->firstOrFail();
        $pathtofail = public_path('documets/' . $doc->recurso);

        return response()->download($pathtofail);
    }


    // inicio act_download
    public function act_download($id)
    {
        $doc = DetalleBloque::where('id', $id)->firstOrFail();
        $pathtofail = public_path('documets/' . $doc->archivo);

        return response()->download($pathtofail);
    }

    // inicio asistencias
    public function asistencias($id)
    {
        $detalleasistencia = AsistenciaDetalle::where('user_id', $id)->get();
        return view('estudiante.asistencias.asistencias', compact('detalleasistencia'));
    }
}
