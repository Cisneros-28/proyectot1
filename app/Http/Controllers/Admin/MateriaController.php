<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function index(){
        $materias = Materia::all();
        return view('admin.materias.index', compact('materias'));
    }
    public function create()
    {

        return view('admin.materias.create');
    }
    public function store(Request $request)
    { //guardar BD los Registro

        $request->validate([
            'descripcion' => 'required|unique:materias,descripcion',
            'estado_materia' => 'required',
        ]);
        $materia = $request->all();

        $materia = new Materia();
        $materia->descripcion = strtoupper($request->descripcion);
        $materia->estado_materia=$request->estado_materia;
        $materia->save();
       //Theme::create($tema);

    // $producto = Producto::create($request->all());
    return redirect()->route('admin.materias.index')->with('mensaje', 'Materia Guardada');;
    }

    public function edit(Materia $materia)
    { // Abrir un formualrio para Edicion de un registro BD


        return view('admin.materias.edit', compact('materia'));
    }
    public function update(Request $request, $id)
    { //Actualizar el regsitro en el BD

        $request->validate([
            'descripcion' => 'required',
            'estado_materia' => 'required',
        ]);
        $materia = $request->all();

        $materia= Materia::findOrFail($id);
        $materia->descripcion = strtoupper($request->descripcion);
        $materia->estado_materia=$request->estado_materia;
        $materia->save();
        //$tema->update($request->validate($rules, $messages));
        return redirect()->route('admin.materias.index')->with('mensaje', 'Materia Actualizada');
    }
    public function destroy(Materia $materia)
    {
        // Eliminar un registro BD
        $materia->delete();
        return redirect()->route('admin.materias.index')->with('deleted', 'Materia Eliminada');
    }

}
