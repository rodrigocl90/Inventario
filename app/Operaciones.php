<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait; //***
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Operaciones extends Model

{
   use Notifiable;
   
    
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */



    protected $fillable = [
        'id_persona', 'tipo_pago','tipo_documento', 'numero_documento','fecha_emision','id_user','tipo_operacion','estado','notas','iva','total','created_at','updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
  
////////////////////////////////////////////////////////////MUTATORS


public function operacion() {
    return $this->belongsTo('App\operacion', 'id_producto', 'id');
  }


public function Users() {
    return $this->belongsTo('App\User', 'id_user', 'id');
  }

public function Personas() {
    return $this->belongsTo('App\Personas', 'id_persona', 'id');
  }



}