<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait; //***
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;



class Role extends EntrustRole
{    use Notifiable;
    use EntrustUserTrait; //**
    use Sluggable;
    use SluggableScopeHelpers;

    protected $slugKeyName = 'slug';

    //
     protected $fillable = [
     
    ];




////////////////////////////////////////////////////////////MUTATORS
 public function setNameAttribute($value)
{
    $this->attributes['name'] = ucwords($value);
}
 public function setdisplaynameAttribute($value)
{
    $this->attributes['display_name'] = ucwords($value);
}


//////////////////////////////////////////////////////////ACCESORS
 



 public function users()
    {
        return $this->belongsToMany('App\User');
    }

      public function sluggable() {
        return [
            'slug' => [
                'source' => 'name',
            ],
          
        ];
    }

    
}
