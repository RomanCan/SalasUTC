<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesores;
use Illuminate\Support\Facades\DB;
use DataTables;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = DB::table('profesores')
            ->join('roles', 'roles.id_rol', '=', 'profesores.id_rol')
            ->select('profesores.nombre as nombre', 'profesores.nivelestudio as nivel', 'profesores.usuario as usuario', 'profesores.password as password', 'profesores.email as email')
            ->where('profesores.usuario', '!=', '')
            ->where('profesores.password', '!=', '')
            ->where('profesores.email', '!=', '')
            ->where('profesores.id_rol', '=', '2')
            ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
        return view('directorCarreras.registroUsuarios');
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
        return $usuarios = Profesores::find($id);
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
