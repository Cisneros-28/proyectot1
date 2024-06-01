<?php

namespace App\Http\Controllers;

use App\Models\AsistenciaDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Redirect;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, Redirect $redirect)
    {
        if (Auth::user()->estado_user == 1) {
        $hoy = date('Y-m-d');
        //return $hoy;
        $user = AsistenciaDetalle::with('user')->where('estado', 'ausente')->where('fecha', $hoy)->where('user_id', Auth::user()->id)->get()->first();
        //return $asistencia;
        if ($user) {
            if (Auth::user()->rol->name == 'ESTUDIANTE') {  // Auth::user()->rol_id ==1 para registrar solo asistencia comparando el rol de la persona

                $asistencia = AsistenciaDetalle::with('user')->find($user->id); // para guardar datos en la base de datos

                $asistencia->estado = 'presente';
                //aqui es para sacar el id del usuario logeado
                $asistencia->save();
            }
        }


            $request->session()->put(['estado' => 'es igual a 1']);
            //return $request->session()->all();
           // $request->session()->invalidate();
            return view('home');
        } elseif (Auth::user()->estado_user == 0) {
            //$request->session()->put(['estado' => 'Usuario no activo']);

            //return $request->session()->invalidate();
            //return $request->session()->regenerate();
            Auth::logout();
            //to('/');
            return redirect()->back();
        }
    }
}
