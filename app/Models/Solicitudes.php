<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Solicitudes extends Model
{
    // use HasFactory;
    protected $table = 'res_solicitudes';
    protected $primaryKey = 'id_solicitud';
    protected $with = ['docentes', 'espacios'];
    public $timestamps = false;
    public $fillable = [
        'cedula',
        'id_espacio',
        'ClaveGrupo',
        'ClaveAsig',
        'tipo_solicitud',
        'fecha_solicitud',
        'fecha_solicitada',
        'fecha_autorizacion',
        'titulo_actividad',
        'detalle_actividad',
        'participantes',
        'status',


    ];
    public function docentes()
    {
        return $this->belongsTo(Profesores::class, 'cedula', 'cedula');
    }
    public function espacios()
    {
        return $this->belongsTo(Espacios::class, 'id_espacio', 'id_espacio');
    }
}