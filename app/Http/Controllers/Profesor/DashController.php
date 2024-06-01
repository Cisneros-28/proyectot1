<?php

namespace App\Http\Controllers\Profesor;

use App\Http\Controllers\Controller;
use App\Models\Actividade;
use App\Models\DetalleBloque;
use App\Models\Tema;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Evaluate;
use App\Models\Activity;
use App\Models\Examene;
use App\Models\Nota;
use App\Models\Respond;
use App\Models\Respuesta;
use Illuminate\Support\Facades\Auth;
use App\Models\Table;

class DashController extends Controller
{
    public function index()
    {
        //leer todos los registros de la BD

        $bloques = DetalleBloque::with('tema')->with('type')->with('bloque')->get();
        $user = User::with('roles')->join('roles', 'users.id_rol', '=', 'roles.id')->where('users.id_curso', Auth::user()->curso->id)->where('roles.name', '=', 'PROFESOR')->select('users.nombre_user', 'users.apellido_user', 'users.email')->get();
        $temas = Tema::with('bloque')->where('curso', '=', Auth::user()->curso->id)->orderBy('id', 'asc')->paginate(10);
        $evaluaciones = Examene::with('tema')->where('id_curso', '=', Auth::user()->curso->id)->orderBy('id', 'asc')->paginate(10);
        $actividades = Actividade::with('tema')->with('curso')->where('id_curso', '=', Auth::user()->curso->id)->orderBy('id', 'asc')->paginate(10);

        return view('profesor.dash.index', compact('evaluaciones', 'bloques', 'user', 'temas', 'actividades'));
    }

    public function show($id) //id de la evaluacion
    { // visualizar un solo registro de BD

        $evaluacion = Examene::findOrFail($id);

        $count = Nota::count();
        if ($count > 0) {


            $estudiantes = User::join("respuestas", "respuestas.id_user", "=", "users.id")
                ->join('preguntas', 'respuestas.id_pregunta', '=', 'preguntas.id')
                ->join('examenes', 'preguntas.id_examen', '=', 'examenes.id')
                ->join('notas', 'notas.id_user', '=', 'users.id')
                ->join('tables','respuestas.id_user','=','tables.user')
                //->join('trimestres','evaluates.id_trimestre','=','trimestres.id')
               // ->join('detalles', 'responds.id', '=', 'detalles.id_respuesta')
                //condicionar si existe notas apra agregar el join notas
                ->where('examenes.id', '=', $id)
                ->where("respuestas.eval", "=", $id)
                ->where('tables.estado',1)
                ->where('notas.id_examen','=',$id)

                ->select("users.nombre_user", "users.apellido_user", 'respuestas.id_user', 'respuestas.eval', 'examenes.id', 'notas.nota_res')
                ->get()->unique('id_user');

                //dd($estudiantes);


$es = User::join("respuestas", "respuestas.id_user", "=", "users.id")
->join('preguntas', 'respuestas.id_pregunta', '=', 'preguntas.id')
->join('examenes', 'preguntas.id_examen', '=', 'examenes.id')
->join('notas', 'notas.id_user', '=', 'users.id')
//condicionar si existe notas apra agregar el join notas
->where('examenes.id', '=', $id)
->where("respuestas.eval", "=", $id)

->get()->pluck('id_user')->unique()->toarray();

$nose = array('notas' => $es);


    $nocalificado = User::join("respuestas", "respuestas.id_user", "=", "users.id")
    ->join('preguntas', 'respuestas.id_pregunta', '=', 'preguntas.id')
    ->join('examenes', 'preguntas.id_examen', '=', 'examenes.id')
    ->join('tables','respuestas.id_user','=','tables.user')
//condicionar si existe notas apra agregar el join notas


->where('examenes.id','=',$id)
    ->where("respuestas.eval", "=",$id)


    //hacer unico no repetir el mismo id del arrego $nose
//->where('users.id','<>',array_filter($nose))
->where('tables.estado',0)
->where('tables.eval',$id)
    ->select("users.nombre_user", "users.apellido_user",'respuestas.id_user','respuestas.eval','examenes.id')
    ->get()->unique('id_user');




return view('profesor.dash.show', compact('count','estudiantes','nocalificado'));

/*

    $notas=User::join("responds", "responds.id_user", "=", "users.id")
    ->join('questioms', 'responds.id_pregunta', '=', 'questioms.id')
    ->join('evaluates', 'questioms.id_evaluate', '=', 'evaluates.id')
->join('notas','responds.id','=','notas.id_res')

->where('evaluates.id','=',$id)
    ->where("responds.eval", "=",$id)
    //esto prueba
    ->select('notas.nota_res','notas.estado_res')
    ->get();

//->pluck("nota_res")->toArray()
    //$sum = array_sum($notas);
//dd($notas);
*/

        } else {

            $estudiantes = User::join("respuestas", "respuestas.id_user", "=", "users.id")
                ->join('preguntas', 'respuestas.id_pregunta', '=', 'preguntas.id')
                ->join('examenes', 'preguntas.id_examen', '=', 'examenes.id')
                ->join('tables','respuestas.id_user','=','tables.user')
                //condicionar si existe notas apra agregar el join notas
                ->where('examenes.id', '=', $id)
                ->where("respuestas.eval", "=", $id)
                ->where('tables.estado',0)
                ->where('tables.eval',$id)
                ->select("users.nombre_user", "users.apellido_user", 'respuestas.id_user', 'respuestas.eval', 'examenes.id')
                ->get()->unique('id_user');


            return view('profesor.dash.show', compact('estudiantes', 'count'));
        }
    }
    public function edit($estudiante, $evaluacion)
    {

        $user = User::where('id', $evaluacion)->pluck('id');
        //->pluck('id');
        $datos = Respuesta::join('users', 'respuestas.id_user', '=', 'users.id')
            ->join('preguntas', 'respuestas.id_pregunta', '=', 'preguntas.id')
            //condicionar si existe notas para agregar el join de notas
            ->where('respuestas.id_user', '=', $evaluacion)
            ->where('respuestas.eval', "=", $estudiante)
            ->select('respuestas.respuesta', 'respuestas.eval', 'preguntas.detalle_pre', 'respuestas.id', 'respuestas.id_pregunta', 'respuestas.id_user')->get();
        //dd($evaluacion);
        //dd($user);
        return view('profesor.dash.edit', compact('datos', 'user'));
    }


    public function store(Request $request)
    {
        $suma = 0;
        $id = 0;
        $e = 0;
        $this->validate(
            $request,
            [
                'nota_res.*' => 'required',
            ]

        );
        $id = $request->id_user;
        $e = $request->id_examen;

        //dd($request);
        // if($request->estado_res > 0){
        $nose = array('notas' => $request['nota_res']);
        for ($i = 1; $i <= count($nose); $i++) {
            $suma = array_sum($request['nota_res']) + $suma;
        }

        $nota = new Nota();
        $nota->nota_res = $suma;
        $nota->id_user = $request->id_user;
        $nota->id_examen = $request->id_examen;
        $nota->save();


        // pruebaaaa


        $tema = Table::where('user', $id)->where('eval', $e)->pluck('id');

        foreach ($tema as $key => $verificar) {
            $table = Table::find($tema[$key]);
            $table->estado = 1;
            $table->save();
        }

        // fin prueba

        return redirect()->route('profesor.dash.index')->with('mensaje', ' Guardada');
    }
}
