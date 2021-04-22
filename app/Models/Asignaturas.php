<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignaturas extends Model
{
    // use HasFactory;
    protected $table = 'asignaturas';
    protected $primaryKey = 'ClaveAsig';
    public $timestamps = false;
    public $fillable = [
        'Nombre',
        'Cuatrimestre',
        'HrsTotales',
        'HrsPracticas',
        'HrsTeoricas',
        'id_plan',
        'idCarrera',
        'id_area',
        'tipo',
    ];
}