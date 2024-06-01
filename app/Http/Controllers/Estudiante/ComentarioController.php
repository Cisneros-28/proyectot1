<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use App\Models\Comentario;
use App\Models\DetalleBloque;
use App\Models\Tema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    public function show($id) //id de la tema
    { // visualizar un solo registro de BD

    $tema = DetalleBloque::find($id);
    $comentarios = Comentario::where('id_comentario',$id)->get();

    return view('comentario.show', compact('tema','comentarios'));

    }


    public function create()
{

}
public function store(Request $request,Tema $tema)
{


    $request->validate([
        'descripcion' => 'required',


    ]);

  $comentario = new Comentario();
  $comentario->descripcion = strtoupper($request->descripcion);
  $comentario->estado = 1;
  $comentario->id_user = Auth::user()->id;
  $comentario->id_comentario = $request->id_tema;
  $comentario->save();

  return redirect()->back()->with('mensaje', 'Comentario Publicado');;
}
public function update()
{
    # code...
}
}
