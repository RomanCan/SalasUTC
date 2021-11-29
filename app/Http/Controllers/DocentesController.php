<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesores;
use Illuminate\Support\Facades\DB;

class DocentesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $docentes = Profesores::all()
        ->where('usuario', '=', '')
                ->where('password', '=', '')
                ->where('email', '=', '')
                ->where('id_rol', '=', '2');
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
        //
        return $docentes = Profesores::find($id);
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
        //
        $docentes = Profesores::find($id);
        $docentes->id_rol = $request->get('id_rol');
        $docentes->nombre = $request->get('nombre');
        $docentes->apellidop = $request->get('apellidop');
        $docentes->apellidom = $request->get('apellidom');
        $docentes->nivelestudio = $request->get('nivelestudio');
        $docentes->profesion = $request->get('profesion');
        $docentes->tratamiento = $request->get('tratamiento');
        $docentes->activo = $request->get('activo');
        $docentes->foto = $request->get('foto');
        $docentes->usuario = $request->get('usuario');
        $docentes->password = $request->get('password');
        $docentes->email = $request->get('email');
        $docentes->update();
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
