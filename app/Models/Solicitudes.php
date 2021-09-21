<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    use HasFactory;
    protected $table = 'res_solicitudes';
    protected $primaryKey = 'id_solicitud';
    protected $with = ['espacio', 'profesor', 'asignatura'];
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
        'hora_inicio',
        'hora_final',
        'asignatura',
    ];

    public function espacio()
    {
        return $this->belongsTo(Espacios::class, 'id_espacio', 'id_espacio');
    }
    public function profesor()
    {
        return $this->belongsTo(Profesores::class, 'cedula', 'cedula');
    }
    public function asignatura()
    {
        return $this->belongsTo(Asignaturas::class, 'ClaveAsig', 'ClaveAsig');
    }
}
