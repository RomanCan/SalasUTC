<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    use HasFactory;
    protected $table = 'res_solicitudes';
    protected $primaryKey = 'id_solicitud';
    public $timestamps = false;

    protected $fillable = [
        'id_solicitud',
        'cedula',
        'id_espacio',
        'fecha_solicitud',
        'fecha_solicitada',
        'fecha_autorizacion',
        'titulo_actividad',
        'detalle_actividad',
        'status',
        'ClaveGrupo',
        'ClaveAsig',
        'participantes',
        'tipo_solicitud',
        'hora_solicitada'
    ];
}
