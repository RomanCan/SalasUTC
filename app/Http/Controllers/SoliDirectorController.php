<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitudes;
use Illuminate\Support\Facades\DB;
use App\Models\Espacios;
use DataTables;

class SoliDirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // return $soli = Solicitudes::all();
        if ($request->ajax()) {
            $data = DB::table('res_solicitudes')
                ->join('res_espacios', 'res_solicitudes.id_espacio', '=', 'res_espacios.id_espacio')
                ->join('res_horarios', 'res_solicitudes.id_horario', '=', 'res_horarios.id_horario')
                ->join('profesores', 'res_solicitudes.cedula', '=', 'profesores.cedula')
                ->select('res_espacios.cupo', 'res_solicitudes.id_espacio', 'res_solicitudes.id_solicitud', 'profesores.nombre as nombre_docente', 'res_solicitudes.asignatura as materia', 'res_solicitudes.titulo_actividad as titulo', 'res_solicitudes.detalle_actividad as detalle', 'res_espacios.nombre as nombre_espacio', 'res_solicitudes.fecha_solicitada as fecha_solicitada', 'res_horarios.hora_inicio as hora_inicio', 'res_horarios.hora_final as hora_final', 'res_solicitudes.status as status')
                ->get();
            return Datatables::of($data)
                // ->addIndexColumn()

                ->addColumn('action', function ($data) {
                    // $id_solicitud = $data->id_solicitud;
                    // $btn = '<button type="button" class="edit btn btn-primary btn-sm btn-ver-dato" data-info="' . $id_solicitud . '">Editar</button>';
                    $status = $data->status;
                    $id = $data->id_solicitud;
                    $id_espacio = $data->id_espacio;
                    $cupo_espacio = $data->cupo;
                    if ($status === 0) {
                        return $mensaje = '<span style=" color: rgb(233, 32, 18)"> <i class="material-icons">warning</i></span>';
                    } elseif ($status === 1 && $cupo_espacio === 0) {
                        return $mensaje = '<span style=" color: rgb(201, 201, 0)">Sala en uso <i class="material-icons">hourglass_top</i></span>';
                    } elseif ($status === 1 && $cupo_espacio === 1) {
                        return $btns =
                            '<button class="btn btn-success btn-sm btn_aceptar" data-espacio="' .
                            $id_espacio .
                            '" data-info="' .
                            $id .
                            '">
                                                <i class="material-icons">done</i>
                                            </button><button class="btn btn-danger btn-sm btn_rechazar" data-espacio="' .
                            $id_espacio .
                            '"data-info="' .
                            $id .
                            '">
                                                <i class="material-icons">highlight_off</i>
                                            </button>';
                    } elseif ($status === 2) {
                        return $mensaje = '<span style=" color: rgb(0, 187, 0)"> <i class="material-icons">check</i></span>';
                    } elseif ($status === 3) {
                        return $mensaje = '<span style=" color: rgb(0, 102, 255)"> <i class="material-icons">verified</i></span>';
                    }

                    // return $btns = '
                    //                         <button class="btn btn-danger btn-sm">
                    //                             <i class="material-icons">highlight_off</i>
                    //                         </button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('directorCarreras.solicitudes');
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
        return $soli = Solicitudes::find($id);
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
        $soli = Solicitudes::find($id);
        // $id_espacio = $request->
        if ($request->status == 2) {
            $cupo = 0;
            $id_espacio = $request->id_espacio;
            DB::update("UPDATE res_espacios SET cupo = $cupo WHERE id_espacio = $id_espacio");
        } else {
            $cupo = 1;
            $id_espacio = $request->id_espacio;
            DB::update("UPDATE res_espacios SET cupo = $cupo WHERE id_espacio = $id_espacio");
        }
        // $soli->cedula = $request->get('cedula');
        // $soli->id_espacio = $request->get('id_espacio');
        // $soli->fecha_solicitud = $request->get('fecha_solicitud');
        // $soli->fecha_solicitada = $request->get('fecha_solicitada');
        // $soli->fecha_autorizacion = $request->get('fecha_autorizacion');
        // $soli->hora_inicio = $request->get('hora_inicio');
        // $soli->hora_final = $request->get('hora_final');
        // $soli->titulo_actividad = $request->get('titulo_actividad');
        // $soli->detalle_actividad = $request->get('detalle_actividad');
        $soli->status = $request->get('status');
        // $soli->ClaveGrupo = $request->get('ClaveGrupo');
        // $soli->ClaveAsig = $request->get('ClaveAsig');
        // $soli->asignatura = $request->get('asignatura');
        // $soli->participantes = $request->get('participantes');
        // $soli->tipo_solicitud = $request->get('tipo_solicitud');
        $soli->update();
        return response()->json($soli, 200, $headers);
    }
    public function prueba(Request $request)
    {
        $s = $request->get('status');
        $id_solicitud = $request->get('id');
        $soli = Solicitudes::find($id_solicitud);
        $soli->status = $s;

        if ($request->status == 2) {
            $cupo = 0;
            $id_espacio = $request->get('id_espacio');
            DB::update("UPDATE res_espacios SET cupo = $cupo WHERE id_espacio = $id_espacio");
        } else {
            $cupo = 1;

            $id_espacio = $request->get('id_espacio');
            DB::update("UPDATE res_espacios SET cupo = $cupo WHERE id_espacio = $id_espacio");
        }
        $soli->update();
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
