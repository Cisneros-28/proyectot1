<?php

namespace App\Http\Controllers\Profesor;

use App\Http\Controllers\Controller;
use App\Models\Bloque;
use App\Models\DetalleBloque;
use App\Models\Recurso;
use App\Models\Tema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetalleBloqueController extends Controller
{
    public function index()
    {
        $bloques = DetalleBloque::with('tema')->with('type')->with('bloque')->get(); //listar todos los loques
        return view('profesor.bloques.index', compact('bloques'));
    }
    public function show($id)
    {
        // Eliminar un registro BD
        $recurso = DetalleBloque::findOrFail($id);
        $recurso->delete();
        return redirect()->route('profesor.bloques.index')->with('deleted', 'Recurso Eliminado');
    }
    public function create()
    {

        $tema = Tema::where('estado_tema','=',1)->pluck('titulo', 'id')->toArray();
        $options = [ null => "NINGUNO"] + $tema;

        $options1 = Bloque::where('estado_b','=',1)->pluck('nombre', 'id')->toArray();
        $bloque = [ null => "SELECCIONE BLOQUE"] + $options1;

        $option3  = Recurso::where('estado','=',1)->pluck('nombre', 'id')->toArray();
        $type = [ null => "SELECCIONE RECURSO"] + $option3;

        return view('profesor.bloques.create', compact('options', 'bloque','type'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'titulo' => 'required',
'id_recurso' => 'required',
'id_bloque' => 'required',
'estado' => 'required'
         ]);

        $recurso = $request->all();

        $recurso = new DetalleBloque();
        $recurso->titulo = strtoupper($request->titulo);
        $recurso->descripcion =$request->descripcion;
        $recurso->id_tema = $request->id_tema;
        $recurso->id_recurso = $request->id_recurso;
        $recurso->id_bloque = $request->id_bloque;
        $recurso->video =$request->video;
        $recurso->id_user= Auth::user()->id;
        $recurso->id_curso= Auth::user()->curso->id;
        $recurso->estado= $request->estado;

        if ($archivo = $request->file('archivo')) {
            $rutaguardar = 'documets/';
            $imagenCat = $archivo->getClientOriginalName();
            //   $imagenCat = $archivo->getClientOriginalName();
            // $imagenCat = date('YmdHis') . "." . $archivo->getClientOriginalExtension();
            $archivo->move($rutaguardar, $imagenCat);
            $recurso['archivo'] = "$imagenCat";
        }

        if ($imagen = $request->file('imagen')) {
            $rutaguardar = 'imagen/';
            //$imagenCat = $imagen->getClientOriginalName();
           //$imagenCat = $imagen->getClientOriginalName();
            $imagenCat = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($rutaguardar, $imagenCat);
            $recurso['imagen'] = "$imagenCat";
        }


        $recurso->save();

        return redirect()->route('profesor.bloques.index')->with('mensaje', 'Recurso guardado Guardada');
    }
    public function edit($id)
    {
        $detalle = DetalleBloque::findOrFail($id);

        $options1 = Bloque::where('estado_b','=',1)->pluck('nombre', 'id')->toArray();
        $bloque = [ null => "SELECCIONE BLOQUE"] + $options1;

        $tema = Tema::where('estado_tema','=',1)->pluck('titulo', 'id')->toArray();
        $options = [ null => "NINGUNO"] + $tema;

        $options3  = Recurso::where('estado','=',1)->pluck('nombre', 'id')->toArray();
        $type = [ null => "SELECCIONE RECURSO"] + $options3;


        return view('profesor.bloques.edit', compact('type', 'bloque', 'detalle','options'));
    }
    public function update(Request $request, $id)
    { //Actualizar el regsitro en el BD

        $request->validate([
            'titulo' => 'required',
            'id_recurso' => 'required',
            'id_bloque' => 'required',
            'estado' => 'required'
        ]);

        $recurso = DetalleBloque::findOrFail($id);
        $recurso->titulo = strtoupper($request->titulo);
        $recurso->descripcion =$request->descripcion;
        $recurso->id_tema = $request->id_tema;
        $recurso->id_recurso = $request->id_recurso;
        $recurso->id_bloque = $request->id_bloque;
        $recurso->video =$request->video;
        $recurso->id_user= Auth::user()->id;
        $recurso->id_curso= Auth::user()->curso->id;
        $recurso->estado= $request->estado;

        if ($archivo = $request->file('archivo')) {
            $rutaguardar = 'documets/';
            $imagenCat = $archivo->getClientOriginalName();
            //   $imagenCat = $archivo->getClientOriginalName();
            // $imagenCat = date('YmdHis') . "." . $archivo->getClientOriginalExtension();
            $archivo->move($rutaguardar, $imagenCat);
            $recurso['archivo'] = "$imagenCat";
        }

        if ($imagen = $request->file('imagen')) {
            $rutaguardar = 'imagen/';
            //$imagenCat = $imagen->getClientOriginalName();
           //$imagenCat = $imagen->getClientOriginalName();
            $imagenCat = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($rutaguardar, $imagenCat);
            $recurso['imagen'] = "$imagenCat";
        }

        $recurso->save();

        return redirect()->route('profesor.bloques.index')->with('mensaje', 'Recurso Actualizado');
    }
    public function destroy($id)
    {
        // Eliminar un registro BD
        $recurso = DetalleBloque::findOrFail($id);
        $recurso->delete();
        return redirect()->route('profesor.bloques.index')->with('deleted', 'Recurso Eliminado');
    }
}
