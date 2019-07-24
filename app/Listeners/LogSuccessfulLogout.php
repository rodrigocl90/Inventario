<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use App\Login as LoginModel;
use Illuminate\Auth\Events\Login;
use Auth;

class LogSuccessfulLogout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
       public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    //
      public function handle(Logout $event)
    {
        
        $user = $event->user;
        $user->last_logout= date('Y-m-d H:i:s');
         $user->timestamps = false;
        $user->save();
        
    


        $empleado =LoginModel::where('session_token', session('_token'))->first();
 if (!empty($empleado)) { 

        $empleado->logout_at = date('Y-m-d H:i:s'); 
        $empleado->save();
}

     
    }
}
