<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index(){
        $cursos = Curso::get();

        return view('admin.cursos.index', compact('cursos'));
     }

     public function create(){
        return view('admin.cursos.create');
     }
     public function store(Request $request){
        $request->validate(
            [
                  'nombre_curso' => 'required|unique:cursos,nombre_curso',
                 'estado_curso' => 'required',


              ]
         );

         $curso = new Curso();
         $curso->nombre_curso=strtoupper($request->nombre_curso);
         $curso->estado_curso=$request->estado_curso;
         $curso->save();

        return redirect()->route('admin.cursos.index')->with('mensaje', 'Curso Guardado');
     }

     public function show(){}

     public function edit($id){
        $curso = Curso::findOrFail($id);
        return view('admin.cursos.edit', compact('curso'));

     }
     public function update(Request $request,$id){
        $request->validate(
            [
                  'nombre_curso' => 'required',
                 'estado_curso' => 'required',


              ]
         );
         $curso= Curso::findOrFail($id);
         $curso->nombre_curso=strtoupper($request->input('nombre_curso'));
         $curso->estado_curso=$request->input('estado_curso');

         $curso->save();

        return redirect()->route('admin.cursos.index')->with('mensaje', 'Curso Actualizado');
     }
     public function destroy($id){
        $curso= Curso::findOrFail($id);
        $curso->delete();

        return redirect()->route('admin.cursos.index')->with('deleted', 'Curso Eliminado');
     }


}
