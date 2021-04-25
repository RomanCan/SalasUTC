<?php


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

Route::get('/', function () {
    return view('index');
});

//LOGIN
Route::view('login', 'login.login');

//Zona de logueo
Route::post('login', 'App\Http\Controllers\ApiUsuarioController@validar');
Route::get('salir', 'App\Http\Controllers\ApiUsuarioController@salir');

//Zona Vistas Director de Carreras
Route::view('espacios', 'directorCarreras.espacios');
Route::view('solicitudes', 'directorCarreras.solicitudes');
Route::view('recursos', 'directorCarreras.recursos');
Route::view('registro_usuarios', 'directorCarreras.registroUsuarios');


//Zona de APIS
Route::apiResource('apiSolicitudes', 'App\Http\Controllers\SolicitudesController');
Route::apiResource('apiEspacios', 'App\Http\Controllers\EspaciosController');
Route::apiResource('apiRecurso', 'App\Http\Controllers\ApiRecursoController');
Route::apiResource('apiRol', 'App\Http\Controllers\RolesController');
Route::apiResource('apiUsuarios', 'App\Http\Controllers\UsuariosController');
Route::apiResource('apiDocentes', 'App\Http\Controllers\DocentesController');

//Envio de Email
Route::POST('contact', 'App\Http\Controllers\EnviarEmailController@mensaje');