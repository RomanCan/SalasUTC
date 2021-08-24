<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocentesGrupos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class DocentesGruposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docente = Session::get('cedula');
        return $dc = DocentesGrupos::where('cedula','=', $docente)->get();
       

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

    public function getDocentesGrupos($id){
        $docenteg = DB::select("SELECT *
                                FROM docentesporgrupo
                                WHERE ClaveGrupo = '$id'");
        return $docenteg;
    }
}
