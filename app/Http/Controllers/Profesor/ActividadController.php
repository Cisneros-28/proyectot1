<?php

namespace App\Http\Controllers\Profesor;

use App\Http\Controllers\Controller;
use App\Models\Actividade;
use App\Models\Tema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ActividadController extends Controller
{
    public function index()
    {
        $actividades = Actividade::with('tema')->where('id_curso','=',Auth::user()->curso->id)->get();
        return view('profesor.actividades.index', compact('actividades'));
    }
    public function create()
    {
        $options = Tema::where('estado_tema', '=', 1)->pluck('titulo','id')->toArray();
        $tema = [ null => "SELECCIONE TEMA"] + $options;

        return view('profesor.actividades.create', compact('tema'));
    }
    public function store(Request $request)
    {


        $request->validate([
            'nombre' => 'required',
            'enlace' => 'required',
            'estado_acti' => 'required',
            'id_tema'=> 'required',

        ]);

        $actividad = new Actividade();
        $actividad->nombre = strtoupper($request->nombre);
        $actividad->enlace = $request->enlace;
        $actividad->estado_acti =$request->estado_acti;
        $actividad->id_tema = $request->id_tema;
        $actividad->id_user = $request->id_user;
        $actividad->id_curso =$request->id_curso;
        $actividad->save();

        return redirect()->route('profesor.actividades.index')->with('mensaje', 'Actividad Guardada');
    }
    public function show()
    {

    }
    public function edit($id)
    {
        $actividad=Actividade::findOrFail($id);
        $options = Tema::where('estado_tema', '=', 1)->pluck('titulo','id')->toArray();
        $temas = [ null => "SELECCIONE TEMA"] + $options;

        return view('profesor.actividades.edit',compact('actividad','temas'));

    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'nombre' => 'required',
            'enlace' => 'required',
            'estado_acti' => 'required',
            'id_tema'=> 'required',
        ]);

        $actividad= Actividade::findOrFail($id);
        $actividad->nombre = strtoupper($request->nombre);
        $actividad->enlace = $request->enlace;
        $actividad->estado_acti =$request->estado_acti;
        $actividad->id_tema = $request->id_tema;
        $actividad->id_user = $request->id_user;
        $actividad->id_curso =$request->id_curso;
        $actividad->save();

        return redirect()->route('profesor.actividades.index')->with('mensaje', 'Actividad Actualizada');
    }
    public function destroy($id)
    {
        $actividad= Actividade::findOrFail($id);
        $actividad->delete();
        return redirect()->route('profesor.actividades.index')->with('deleted', 'Actividad Eliminada');
    }
}
