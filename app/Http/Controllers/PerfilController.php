<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Profesores;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perfil = Session::get('cedula');
        return $profesor = Profesores::where('cedula', '=', $perfil)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $perfil = Profesores::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'usuario' => 'required',
                // 'usuario' => ['required', 'unique:profesores,usuario'],
                'password' => 'required',
                // 'password' => ['required', 'unique:profesores,password'],
                'email' => ['required', 'email']
                // 'email' => ['required', 'email', 'unique:profesores,email'],
            ],
            [
                'usuario.required' => 'No deje el campo vacío',
                // 'usuario.unique' => 'El usuario ya existe, intente con otro nombre de usuario',
                'password.required' => 'Es necesario que se ingrese una contraseña',
                // 'password.unique' => 'La contraseña ya existe, inserte otra opción',
                'email.required' => 'El email es obligatorio',
                // 'email.unique' => 'El correo ya existe',
                'email.email' => 'Ingrese un correo válido'
            ],
        );

        $perfil = Profesores::find($id);
        $perfil->cedula = $request->get('cedula');
        $perfil->usuario = $request->get('usuario');
        $perfil->password = $request->get('password');
        $perfil->email = $request->get('email');
        $perfil->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
