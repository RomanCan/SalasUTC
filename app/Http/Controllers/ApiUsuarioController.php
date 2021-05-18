<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesores;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;


class ApiUsuarioController extends Controller
{
    public function validar(Request $request)
    {
        $usuario = $request->user;
        $password = $request->password;

        $resp = Profesores::where('usuario', '=', $usuario)
            ->where('password', '=', $password)
            ->get();

        if (count($resp) > 0) {
            $usuario = $resp[0]->nombre . ' ' . $resp[0]->apellidop . ' ' . $resp[0]->apellidom;
            Session::put('usuario', $usuario);
            Session::put('rol', $resp[0]->rol->rol);
            Session::put('id_usuario', $resp[0]->id_usuario);
            if ($resp[0]->rol->rol == "Coordinador") {
                return Redirect::to('registro_usuarios');
            } else if ($resp[0]->rol->rol == "Docente") {
                return Redirect::to('docente-perfil');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function salir()
    {
        Session::flush();
        Session::reflash();
        Cache::flush();
        Cookie::forget('laravel_session');
        unset($_COOKIE);
        unset($_SESSION);
        return Redirect::to('/login');
    }
}