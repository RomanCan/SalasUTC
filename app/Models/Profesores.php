<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesores extends Model
{
    // use HasFactory;
    protected $table = 'profesores';
    protected $priamryKey = 'cedula';
    public $timestamps = false;
    public $fillable = [
        'nombre',
        'apellidop',
        'apellidom',
        'nivelestudio',
        'profesion',
        'tratamiento',
        'activo',
        'foto',
    ];
}