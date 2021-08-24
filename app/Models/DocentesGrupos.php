<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocentesGrupos extends Model
{
    // use HasFactory;
    protected $table = 'docentesporgrupo';
    protected $primaryKey = 'ClaveCarga';
    protected $with = ['docente', 'asignatura'];
    
    public $timestamps = false;
    public $fillable = [
        'ClaveAsig',
        'cedula',
        'ClaveGrupo',
        'Periodo',
    ];
    public function docente()
    {
        return $this->belongsTo(Profesores::class, 'cedula', 'cedula');
    }
    public function asignatura()
    {
        return $this->belongsTo(Asignaturas::class, 'ClaveAsig', 'ClaveAsig');
    }
}