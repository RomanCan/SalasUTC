<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{
    use HasFactory;
    protected $table = 'res_horarios';
    protected $primaryKey = 'id_horario';
    public $timestamps = false;
    public $fillable = [
        'horario',
        'fecha',
        
    ];
}
