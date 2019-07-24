<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Login extends Model
{
    
    
    protected $slugKeyName = 'slug';
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

  

    protected $dates = ['login_at', 'logout_at'];

    protected $fillable = [
        'user_agent', 'session_token', 'ip_address','login_at','user_id','logout_at'
    ];
public $timestamps = false;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
 


      public function user()
    {
        return $this->belongsToMany('App\User');
    }

}

