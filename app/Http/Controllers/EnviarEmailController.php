<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EnviarEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function mensaje(Request $request)
    {
        $subject = "Solicitud de laboratirio";
        $nombreDirector = $request->director;
        $cargo = $request->cargo;
        $fecha = $request->fecha;
        $laboratorio = $request->laboratorio;
        $motivo = $request->motivo;

        $emailSchool = "romancan33@gmail.com";
        $docente = $request->docente;
        $fromemail = $request->email;

        Mail::send('emails.contactanos', $request->all(), function ($mensaje) use ($subject, $docente, $emailSchool, $fromemail, $nombreDirector, $cargo, $fecha, $laboratorio, $motivo) {
            $mensaje->from($fromemail, $docente);
            $mensaje->subject($subject);
            $mensaje->to($emailSchool, "Laboratorios");
            // $mensaje->sender('john@johndoe.com', 'John Doe');
            // $mensaje->cc('john@johndoe.com', 'John Doe');
            // $mensaje->bcc('john@johndoe.com', 'John Doe');
            // $mensaje->replyTo('john@johndoe.com', 'John Doe');
            // $mensaje->priority(3);
            // $mensaje->attach('pathToFile');
        });
        return redirect()->back();
    }
    public function user(Request $request)
    {
        $subject = "Nombre de usuario y contraseña";
        $nombre = $request->nombre;
        $apellidop = $request->apellidop;
        $apellidom = $request->apellidom;
        $tratamiento = $request->tratamiento;
        // $docente = $tratamiento + $nombre + $apellidop + $apellidom;
        $director = "Puga Sosa";
        $emailDirec = "directorCarreras@Utcentro.com";
        $user = $request->usuario;
        $password = $request->password;
        $email = $request->email;

        Mail::send('emails.username', $request->all(), function ($mensaje) use ($director, $emailDirec, $nombre, $user, $password, $email, $subject) {
            $mensaje->from($emailDirec, $director);
            $mensaje->subject($subject);
            $mensaje->to($email, $nombre);
        });
    }
}