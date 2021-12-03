<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Espacios;

class EspacioSolicitudController extends Controller
{
    //
    public function index()
    {
        return $espacios = Espacios::all();
    }
    public function store(Request $request)
    {
        //
        $this->validate(
            $request,
            [
                'nombre' => 'required',
                'ubicacion' => 'required',
                'cupo' => 'required',
            ],
            [
                'nombre.required' => 'Ingrese el nombre.',
                'ubicacion.required' => 'Establezca la ubicación.',
                'cupo.required' => 'el campo cupo es requerido',

            ],
        );
        $salas = new Espacios();
        $salas->nombre = $request->get('nombre');
        $salas->ubicacion = $request->get('ubicacion');
        $salas->cupo = $request->get('cupo');
        $salas->save();
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
        return $salas = Espacios::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $id_espacio = $request->get('id_espacio');
        $nombre = $request->get('nombre');
        $ubicacion = $request->get('ubicacion');
        $cupo = $request->get('cupo');

        $salas = Espacios::find($id_espacio);
        $salas->nombre = $nombre;
        $salas->ubicacion = $ubicacion;
        $salas->cupo = $cupo;
        $salas->update();
    }
    public function prueba(Request $request)
    {
        $id_espacio = $request->get('id_espacio');
        $nombre = $request->get('nombre');
        $ubicacion = $request->get('ubicacion');
        $cupo = $request->get('cupo');

        $salas = Espacios::find($id_espacio);
        $salas->nombre = $nombre;
        $salas->ubicacion = $ubicacion;
        $salas->cupo = $cupo;
        $salas->update();
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
        return Espacios::destroy($id);
    }
}
