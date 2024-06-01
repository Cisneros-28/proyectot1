<?php

namespace App\Http\Controllers\Profesor;

use App\Http\Controllers\Controller;
use App\Models\Pregunta;
use Illuminate\Http\Request;

class PreguntaController extends Controller
{
    public function edit(Pregunta $pregunte)
    { // Abrir un formualrio para Edicion de un registro BD
        return view('profesor.preguntes.edit', compact('pregunte'));
    }

    public function update(Request $request,$id)
    { //Actualizar el regsitro en el BD


        $request->validate([
            'detalle_pre' => "required|unique:preguntas,detalle_pre,$id",


        ]);

        $pregunte= Pregunta::findOrFail($id);
        $pregunte->detalle_pre=strtoupper($request->input('detalle_pre'));

        $pregunte->save();

        return redirect()->route('profesor.preguntes.edit', $pregunte)->with('mensaje', 'Pregunta Actualizado');
    }
    public function destroy(Pregunta $pregunte)
    {
// Eliminar un registro BD
$pregunte->delete();
return redirect()->route('profesor.evaluaciones.index')->with('deleted', 'Pregunta Eliminada');
}
}
