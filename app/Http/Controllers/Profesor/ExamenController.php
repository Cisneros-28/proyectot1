<?php

namespace App\Http\Controllers\Profesor;

use App\Http\Controllers\Controller;
use App\Models\Examene;
use App\Models\Pregunta;
use App\Models\Tema;
use App\Models\Trimestre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamenController extends Controller
{
    public function index()
    {
        $evaluaciones = Examene::with('tema')->
        where('id_curso','=',Auth::user()->curso->id)
        ->with('trimestre')
        ->orderBy('id', 'asc')->paginate(10);
        return view('profesor.evaluaciones.index', compact('evaluaciones'));
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { //abrir formulario para un nuevo registro
        $options = Trimestre::where('estado_t','=',1)->pluck('descripcion','id')->toArray();
        $trimestre = [ null => "SELECCIONE TRIMESTRE"] + $options;
        $options1 = Tema::where('estado_tema','=',1)->pluck('titulo', 'id')->toArray();
        $temas = [ null => "SELECCIONE TEMA"] + $options1;

        return view('profesor.evaluaciones.create', compact('temas','trimestre'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //id de la evaluacion
    { // visualizar un solo registro de BD
        $evaluacion= Examene::findOrFail($id);
        $preguntas = Pregunta::where('id_examen',$id)->get();

        return view('profesor.evaluaciones.show', compact('preguntas','id','evaluacion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { //guardar BD los Registro


        $request->validate([
            'nombre' => 'required',
            'estado_eval' => 'required',
            'id_tema' => 'required',
            'id_user' => 'required',
            'id_curso'=>'required',
            'id_trimestre' => 'required'
        ]);

        $evaluacion = new Examene();
        $evaluacion->nombre = strtoupper($request->nombre);
        $evaluacion->estado_eval=$request->estado_eval;
        $evaluacion->id_tema = $request->id_tema;
        $evaluacion->id_user = $request->id_user;
        $evaluacion->id_curso = $request->id_curso;
        $evaluacion->id_trimestre =$request->id_trimestre;
        $evaluacion->save();

        return redirect()->route('profesor.evaluaciones.index')->with('mensaje', 'Evaluacion Guardada');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { // Abrir un formualrio para Edicion de un registro BD
        $options = Trimestre::where('estado_t','=',1)->pluck('descripcion','id')->toArray();
        $trimestre = [ null => "SELECCIONE TRIMESTRE"] + $options;
        $options1 = Tema::where('estado_tema','=',1)->pluck('titulo', 'id')->toArray();
        $temas = [ null => "SELECCIONE TEMA"] + $options1;
        $evaluacion = Examene::findOrFail($id);

    return view('profesor.evaluaciones.edit', compact('evaluacion', 'temas','trimestre'));
    }

    public function update(Request $request, $id)
    { //Actualizar el regsitro en el BD

        $request->validate(
          [
                'nombre' => 'required',
               'estado_eval' => 'required',
                'id_tema' => 'required',
                'id_user' => 'required',
'id_curso'=>'required',
'id_trimestre' => 'required'
            ]
       );
       $evaluacion= Examene::findOrFail($id);
       $evaluacion->nombre = strtoupper($request->nombre);
       $evaluacion->estado_eval=$request->input('estado_eval');
       $evaluacion->id_tema=$request->input('id_tema');
       $evaluacion->id_user=$request->input('id_user');
       $evaluacion->id_curso = $request->input('id_curso');
       $evaluacion->id_trimestre =$request->id_trimestre;
       $evaluacion->save();

        return redirect()->route('profesor.evaluaciones.index')->with('mensaje','Evaluacion Actualizada');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Eliminar un registro BD
        $evaluacion= Examene::findOrFail($id);
        $evaluacion->delete();
        return redirect()->route('profesor.evaluaciones.index')->with('deleted', 'Evaluacion Eliminada');
    }

    public function preguntas($id){
        //$evaluaciones= Evaluate::findOrFail($id)->first();
        $evaluaciones= Examene::where('id',$id)->pluck('id');
        
        return view('profesor.evaluaciones.preguntas', compact('evaluaciones'));

    }
    public function stpre(Request $request)
    { //guardar BD los Registro

        $this->validate($request,[
            'pregunta.*' => 'required|unique:preguntas,detalle_pre',
            'id_examen.*' => 'required',
            ]

        );
        foreach($request->pregunta as $key=>$pregunta){

            $pregunte = new Pregunta();
            $pregunte->detalle_pre = strtoupper($pregunta);
            $pregunte->id_examen = $request->id_examen[$key];
            //dd($pregunte);
            $pregunte->save();
        }


        return redirect()->route('profesor.evaluaciones.index')->with('mensaje', 'Preguntas Guardadas');;
    }
}
