<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait; //***
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Empresas extends Model

{
   use Notifiable;
   
    
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = [
        'nombre', 'email','rut', 'telefono','imagen','created_at','domicilio','ciudad','fax','codigo_postal','giro','updated_at'
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




////////////////////////////////////////////////////////////MUTATORS





}