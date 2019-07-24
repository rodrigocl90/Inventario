<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait; //***
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model

{
   use Notifiable;
   
    
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = [
        'nombre', 'descripcion', 'estado','updated_at','created_at','imagen','codigo','stock','id_categoria','estado','precio'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
  



////////////////////////////////////////////////////////////MUTATORS
 public function setnombreAttribute($value)
{
    $this->attributes['nombre'] = ucwords($value);
}
 public function setfirstdescripcionAttribute($value)
{
    $this->attributes['descripcion'] = ucwords($value);
}

//////////////////////////////////////////////////////////ACCESORS
 
 
    /**

PHP strtoupper(): Convierte a mayúsculas los caracteres de una cadena string.
PHP strtolower(): Convierte a minúsculas los caracteres de una cadena string.
PHP ucfirst(): Convierte a mayúsculas el primer caracter de una cadena string.
PHP ucwords(): Convirte a mayúsculas el primer caracter de cada palabra de una cadena o string.

*/


public function getnombreAttribute($value)
{
    return  ucwords($value);
}

public function getdescripcionAttribute($value)
{
    return  ucwords($value);
}



////////////////////////////////////////////////////////////MUTATORS



   public function entradas_temporales()
    {
        return $this->belongsTo('App\User');
    }


}