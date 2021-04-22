<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    // use HasFactory;

     // esta linea sirve para vincular el modelo con una tabla.
     protected $table='recursos';

     // se especifica la clave primaria.
     protected $primaryKey='id_recurso';
 
     // cuando no sea un numero la clave primaria y sea un varchar poner el siguiente comando.
     // public $incrementing=false;
 
     // desactiva las etiquetas de tiempo.
     public $timestamps=false;
 
     // definimos los campos que van a recivir valor de los que se pueden pedir por el usuario.
 
     protected $fillable=[
         'id_recurso',
         'recurso'
         
         
     ];
}
