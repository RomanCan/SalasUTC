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

//Zona Vistas Director de Carreras
Route::view('salas', 'directorCarreras.salas');

//Envio de Email
Route::POST('contact', 'App\Http\Controllers\EnviarEmailController@mensaje');