<?php

namespace App\Http\Controllers\Profesor;

use App\Http\Controllers\Controller;
use App\Models\Tema;
use Illuminate\Http\Request;
use App\Models\Bloque;
use App\Models\Materia;
use Illuminate\Support\Facades\Auth;

class TemaController extends Controller
{
    public function index(){
        $temas = Tema::with('bloque')->where('curso','=',Auth::user()->curso->id)->get();
        return view('profesor.temas.index', compact('temas'));
    }
    public function create()
    {
        $options=Bloque::where('estado_b','=',1)->pluck('nombre','id')->toArray(); //where('nombre','=','BLOQUE ACADEMICO')->
        $bloque = [ null => "SELECCIONE BLOQUE"] + $options;
        $options1 = Materia::where('estado_materia','=',1)->where('descripcion', 'GUARANI')->pluck('descripcion','id','estado_materia')->toArray();
        $materia = [ null => "SELECCIONE MATERIA"] + $options1;
        return view('profesor.temas.create',compact('materia','bloque'));
    }
    public function show(Tema $tema)
    { // visualizar un solo registro de BD
        return view('profesor.temas.show');
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
            'titulo' => 'required|unique:temas,titulo',
            'detalle_tema' => 'required',
            'recurso' => 'required|mimes:pdf',
            'id_bloque' => 'required',
            'id_materia' => 'required',
            'estado_tema' => 'required'
        ]);
        $tema = $request->all();

        $tema = new Tema();
        $tema->titulo = strtoupper($request->titulo);
        $tema->detalle_tema =strtoupper($request->detalle_tema);
        $tema->id_materia =$request->id_materia;
        $tema->curso =$request->curso;
        $tema->id_bloque =$request->id_bloque;
        $tema->id_user = Auth::user()->id;
        $tema->estado_tema = $request->estado_tema;

        if($recurso=$request->file('recurso')){
            $rutaguardar ='documets/';
            $imagenCat =$recurso->getClientOriginalName();
            //date('YmdHis').".".$recurso->getClientOriginalExtension();
            $recurso->move($rutaguardar, $imagenCat);
            $tema['recurso']="$imagenCat";

        }
        $tema->save();

    return redirect()->route('profesor.temas.index')->with('mensaje', 'Tema Guardado');;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tema $tema)
    { // Abrir un formualrio para Edicion de un registro BD
        $options=Bloque::where('estado_b','=',1)->pluck('nombre','id')->toArray(); //where('nombre','=','BLOQUE ACADEMICO')->
        $bloque = [ null => "SELECCIONE BLOQUE"] + $options;
        $options1 = Materia::where('estado_materia','=',1)->where('descripcion', 'GUARANI')->pluck('descripcion','id')->toArray();
        $materia = [ null => "SELECCIONE MATERIA"] + $options1;
        return view('profesor.temas.edit', compact('tema','materia','bloque'));
    }
    public function update(Request $request, $id)
    { //Actualizar el regsitro en el BD


        $request->validate([
            'titulo' => 'required',
            'detalle_tema' => 'required',
            'recurso' => 'nullable',
            'id_bloque' => 'required',
            'id_materia' => 'required',
            'estado_tema' => 'required'
        ]);

        $tema= Tema::findOrFail($id);
        $tema->titulo = strtoupper($request->titulo);
        $tema->detalle_tema =strtoupper($request->detalle_tema);
        $tema->id_materia =$request->id_materia;
        $tema->curso =$request->curso;
        $tema->id_bloque =$request->id_bloque;
        $tema->id_user = Auth::user()->id;
        $tema->estado_tema = $request->estado_tema;

        if($recurso=$request->file('recurso')){
            $rutaguardar ='documets/';
            $imagenCat =  $recurso->getClientOriginalName();
            //date('YmdHis').".".$recurso->getClientOriginalExtension();
            $recurso->move($rutaguardar, $imagenCat);
            $tema['recurso']="$imagenCat";

        }


        $tema->save();

        return redirect()->route('profesor.temas.index')->with('mensaje', 'Tema Actualizado');
    }
    public function destroy(Tema $tema)
    {
        // Eliminar un registro BD
        $tema->delete();
        return redirect()->route('profesor.temas.index')->with('deleted', 'Tema Eliminado');
    }
}
