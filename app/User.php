<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait; //***
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
   use Notifiable;
    use EntrustUserTrait; //**
    use Sluggable;
    use SluggableScopeHelpers;
    
    protected $slugKeyName = 'slug';
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'email', 'password','gender','phone','name','last_name','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];
 protected $guarded = ['id','slug'];




public function logins()
    {
        return $this->hasMany('App\Login');
    }

      public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function sluggable() {
        return [
            'slug' => [
                'source' => 'name',
            ],
          
        ];
    }


////////////////////////////////////////////////////////////MUTATORS
 public function setNameAttribute($value)
{
    $this->attributes['name'] = ucwords($value);
}
 public function setfirstnameAttribute($value)
{
    $this->attributes['first_name'] = ucwords($value);
}
 public function setlastnameAttribute($value)
{
    $this->attributes['last_name'] = ucwords($value);
}

//////////////////////////////////////////////////////////ACCESORS
 
 
    /**

PHP strtoupper(): Convierte a mayúsculas los caracteres de una cadena string.
PHP strtolower(): Convierte a minúsculas los caracteres de una cadena string.
PHP ucfirst(): Convierte a mayúsculas el primer caracter de una cadena string.
PHP ucwords(): Convirte a mayúsculas el primer caracter de cada palabra de una cadena o string.

*/


public function getfirstnameAttribute($value)
{
    return  ucwords($value);
}

public function getlastnameAttribute($value)
{
    return  ucwords($value);
}

public function getnameAttribute($value)
{
    return  ucwords($value);
}

////////////////////////////////////////////////////////////MUTATORS
    
}
