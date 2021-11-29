<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitudes;
use Illuminate\Support\Facades\DB;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $evento = DB::select("select res_solicitudes.titulo_actividad AS title, CONCAT(res_solicitudes.fecha_solicitada,' ',res_horarios.hora_inicio) AS start, CONCAT(res_solicitudes.fecha_solicitada,' ',res_horarios.hora_final) AS end, res_solicitudes.status as status from res_solicitudes JOIN res_horarios ON res_solicitudes.id_horario = res_horarios.id_horario WHERE res_solicitudes.status = 1 || res_solicitudes.status = 2");

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
