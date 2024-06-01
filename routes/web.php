<?php

use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;
//controladores admin
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MateriaController;
use App\Http\Controllers\Admin\CursoController;

//controladores secretaria
use App\Http\Controllers\Secretaria\UserController as SecretariaUserController;
//controladores director
use App\Http\Controllers\Director\UserController as DirectorUserController;

//controladores profesor
use App\Http\Controllers\Profesor\DashController;
use App\Http\Controllers\Profesor\TemaController as ProfesorThemeController;
use App\Http\Controllers\Profesor\ActividadController as ProfesorActivityController;
use App\Http\Controllers\Profesor\ExamenController as ProfesorEvaluateController;
use App\Http\Controllers\Profesor\PreguntaController as ProfesorQuestiomController;
use App\Http\Controllers\Profesor\UserController as ProfesorUsernameController;
use App\Http\Controllers\Profesor\AsistenciaController;
use App\Http\Controllers\Profesor\ComentarioController as ProfesorComentarioController;


//controladores estudiante
use App\Http\Controllers\Estudiante\RespuestaController as EstudianteRespondController;
use App\Http\Controllers\Estudiante\ComentarioController as EstudianteComentarioController;
use App\Http\Controllers\Profesor\DetalleBloqueController;
use App\Http\Controllers\Profesor\BloqueController;
use App\Http\Controllers\Profesor\RecursoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//admin
Route::resource('admin/permisos',RoleController::class)->names('admin.permisos');
Route::resource('admin/usuarios', UserController::class)->names('admin.usuarios');
Route::resource('admin/materias', MateriaController::class)->names('admin.materias');
Route::resource('admin/cursos', CursoController::class)->names('admin.cursos');
//secretaria -------crea estudiante
Route::resource('secretaria/estudiantes',SecretariaUserController::class)->names('secretaria.estudiantes');
//director -------crea profesores
Route::resource('director/profesores',DirectorUserController::class)->names('director.profesores');

//profesor
Route::resource('profesor/recursos',RecursoController::class)->names('profesor.recursos');
Route::resource('profesor/bloques',DetalleBloqueController::class)->names('profesor.bloques');
///Route::resource('profesor/dash',BloqueController::class)->names('profesor.dash');
Route::resource('profesor/dash', DashController::class)->names('profesor.dash');
Route::resource('profesor/temas', ProfesorThemeController::class)->names('profesor.temas');
Route::resource('profesor/actividades',ProfesorActivityController::class)->names('profesor.actividades');
Route::resource('profesor/evaluaciones', ProfesorEvaluateController::class)->names('profesor.evaluaciones');
Route::resource('profesor/preguntes', ProfesorQuestiomController::class)->names('profesor.preguntes');
Route::resource('profesor/estudiantes', ProfesorUsernameController::class)->names('profesor.estudiantes');
Route::get('profesor/estudiantes/notas/{id}', [ProfesorUsernameController::class,'notas'])->name('profesor.estudiantes.notas');
Route::get('profesor/reportes/pdf/{id}', [ProfesorUsernameController::class,'pdf'])->name('profesor.reportes.index');
Route::get('profesor/dash/{evaluacion}/edit/{estudiante}', [DashController::class,'edit'])->name('profesor.dash.edit');
//Route::get('profesor/dash', [DashController::class,'stor'])->name('profesor.dash.stor');
Route::get('profesor/evaluaciones/{id}/preguntas',[ProfesorEvaluateController::class,'preguntas'])->name('profesor.evaluaciones.preguntas');
Route::post('profesor/evaluaciones/preguntas/stpre',[ProfesorEvaluateController::class,'stpre'])->name('profesor.evaluaciones.stpre');
//ASISTENCIAS
Route::resource('profesor/asistencias', AsistenciaController::class)->names('profesor.asistencias');
Route::get('profesor/estudiantes/asistencia/{id}',[ProfesorUsernameController::class,'asistencia'])->name('profesor.reportes.asistencia');



//estudiante 'prefix'=>'ESTUDIANTE', 'middleware'=>['position::ESTUDIANTE']
Route::middleware(['auth'])->group(function(){
    Route::resource('estudiante/respuesta',EstudianteRespondController::class)->names('estudiante.respuesta');
    Route::get('estudiante/respuesta/{id}/asistencias',[EstudianteRespondController::class,'asistencias'])->name('estudiante.asistencias.asistencias');
    Route::get('estudiante/respuesta/{id}/download',[EstudianteRespondController::class,'download'])->name('estudiante.respuesta.download');
    Route::get('estudiante/respuesta/{id}/act_download',[EstudianteRespondController::class,'act_download'])->name('estudiante.respuesta.act_download');

});

Route::resource('comentario',EstudianteComentarioController::class)->names('comentario');
//fin


Route::post('profesor/asistencias/update',[AsistenciaController::class,'update'])->name('profesor.asistencias.update');








