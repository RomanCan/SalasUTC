<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class EnviarEmail extends Controller
{
    //
    public function mensaje(Request $request)
    {
        $subject = "Solicitud de laboratirio";

        $emailSchool = "laboratorios@Utcentro.com";

        $docente = $request->nombre;
        $fromemail = $request->email;

        Mail::send('contactanos', $request->all(), function ($mensaje) use ($subject, $docente, $emailSchool, $fromemail) {
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
}