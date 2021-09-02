<?php

use App\Http\Middleware\EnsureUserHasRole;
use App\Http\Middleware\RoutesMiddleware;
use Illuminate\Support\Facades\Route;


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

// Route::get('/', function () {
//     return view('index');
// });

//LOGIN
Route::view('/', 'login.login')->name('/');

//Zona de logueo
Route::post('log', 'App\Http\Controllers\ApiUsuarioController@validar');
Route::get('salir', 'App\Http\Controllers\ApiUsuarioController@salir');

Route::middleware(['rutas'])->group(function () {
    //Zona Vistas Director de Carreras
    Route::view('espacios', 'directorCarreras.espacios');
    Route::view('solicitudes', 'directorCarreras.solicitudes');
    Route::view('recursos', 'directorCarreras.recursos');
    Route::view('registro_usuarios', 'directorCarreras.registroUsuarios');

    //Zona Vistas Docentes
    Route::view('docente-perfil', 'docentes.perfil');
    Route::view('docente-calendario', 'docentes.calendario');
    Route::view('docente-solicitud', 'docentes.solicitudes');
    Route::view('index', 'index');


    //Envio de Email
    Route::POST('contact', 'App\Http\Controllers\EnviarEmailController@mensaje');
    Route::POST('username', 'App\Http\Controllers\EnviarEmailController@user');
    Route::POST('aceptar_soli', 'App\Http\Controllers\EnviarEmailController@aceptarSolicitud');
    Route::POST('rechazar_soli', 'App\Http\Controllers\EnviarEmailController@rechazarSolicitud');
});



//Zona de APIS
Route::apiResource('apiSolicitudes', 'App\Http\Controllers\SolicitudesController');
Route::apiResource('apiEspacios', 'App\Http\Controllers\EspaciosController');
Route::apiResource('apiRecurso', 'App\Http\Controllers\ApiRecursoController');
Route::apiResource('apiRol', 'App\Http\Controllers\RolesController');
Route::apiResource('apiUsuarios', 'App\Http\Controllers\UsuariosController');
Route::apiResource('apiDocentes', 'App\Http\Controllers\DocentesController');
Route::apiResource('apiDocentesGrupos', 'App\Http\Controllers\DocentesGruposController');
Route::apiResource('apiHorarios', 'App\Http\Controllers\HorariosController');
Route::apiResource('apiSoliDirector', 'App\Http\Controllers\SoliDirectorController');

//  Api para traer al maestro de la solicitud
Route::apiResource('apiSoliDocentes', 'App\Http\Controllers\SoliDocenteController');
Route::apiResource('apiPerfilDocentes', 'App\Http\Controllers\PerfilController');



// funcion cascada
// traer la clave de asignatura por cada clave de grupo
Route::get('getDocentesGrupos/{id}', [
    'as' => 'getDocentesGrupos',
    'uses' => 'App\Http\Controllers\DocentesGruposController@getDocentesGrupos',
]);

//  claves de docentes
Route::get('getClaveGrupo/{id}', [
    'as' => 'getClaveGrupo',
    'uses' => 'App\Http\Controllers\ClaveGrupoController@getClaveGrupo',
]);
// traer nombre de asignatura por cada clave de asignatura
Route::get('getAsignaturas/{id}', [
    'as' => 'getAsignaturas',
    'uses' => 'App\Http\Controllers\AsignaturasController@getAsignaturas',
]);

Route::apiResource('apiHorarios', 'App\Http\Controllers\HorariosController');

//Envio de Email
// Route::POST('contact', 'App\Http\Controllers\EnviarEmailController@mensaje');
// Route::POST('username', 'App\Http\Controllers\EnviarEmailController@user');
