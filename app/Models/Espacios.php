<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Espacios extends Model
{
    // use HasFactory;
    protected $table = 'res_espacios';
    protected $primaryKey = 'id_espacio';
    public $timestamps = false;
    public $fillable = [
        'nombre',
        'ubicacion',
        'cupo'
    ];
}