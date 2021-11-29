<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Espacios;
use Illuminate\Support\Facades\DB;
use DataTables;

class EspaciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data = Espacios::select('id_espacio', 'nombre', 'ubicacion', 'cupo')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $id_espacio = $data->id_espacio;
                $nombre = $data->nombre;
                $ubicacion = $data->ubicacion;
                $cupo = $data->cupo;

                $btn =
                    '<button type="button" class="edit btn btn-success btn-sm btn-ver-dato"
                 data-espacio="' .
                    $id_espacio .
                    '">Editar</button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        // return view('directorCarreras.espacios');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
