<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesores extends Model
{
    // use HasFactory;
    protected $table = 'profesores';
    protected $primaryKey = 'cedula';
    protected $with = ['rol'];
    public $incrementing = false;
    public $timestamps = false;
    public $fillable = [
        'id_rol',
        'nombre',
        'apellidop',
        'apellidom',
        'nivelestudio',
        'profesion',
        'tratamiento',
        'activo',
        'foto',
        'usuario',
        'password',
        'email',
    ];
    public function rol()
    {
        return $this->belongsTo(Roles::class, 'id_rol', 'id_rol');
    }
}