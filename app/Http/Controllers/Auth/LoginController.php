<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Login as LoginModel;
use Illuminate\Auth\Events\Login;
use Auth; 
use Session;
use App\Common\Utility; 




class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


///PARA UN INICIO DE SESSION
protected function sendLoginResponse(Request $request)
{
     Utility::stripXSS(); 

    $request->session()->regenerate();
    $previous_session = Auth::User()->session_id;
    if ($previous_session) {
        \Session::getHandler()->destroy($previous_session);
    }

    Auth::user()->session_id = \Session::getId();
    Auth::user()->save();
    $this->clearLoginAttempts($request);

    return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
}  


///PARA UN INICIO DE SESSION




///PARA LIMITES DE INTENTOS

protected function hasTooManyLoginAttempts(Request $request)
{   Utility::stripXSS(); 


    $attempts = 2;
    $lockoutMinites = 9;
    return $this->limiter()->tooManyAttempts(
        $this->throttleKey($request), $attempts, $lockoutMinites
    );
}





///PARA LIMITES DE INTENTOS



public function login(Request $request)
{
    Utility::stripXSS(); 



    $this->validateLogin($request);

    // If the class is using the ThrottlesLogins trait, we can automatically throttle
    // the login attempts for this application. We'll key this by the username and
    // the IP address of the client making these requests into this application.
    if ($this->hasTooManyLoginAttempts($request)) {
        $this->fireLockoutEvent($request);

        return $this->sendLockoutResponse($request);
    }

    if ($this->attemptLogin($request)) {
        return $this->sendLoginResponse($request);
    }

    // If the login attempt was unsuccessful we will increment the number of attempts
    // to login and redirect the user back to the login form. Of course, when this
    // user surpasses their maximum number of attempts they will get locked out.
    $this->incrementLoginAttempts($request);

    return $this->sendFailedLoginResponse($request);
}




protected function authenticated(Request $request)
{    Utility::stripXSS(); 

        $login = new LoginModel;
        $login->user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        $login->session_token = session('_token');
        $login->ip_address = $_SERVER['REMOTE_ADDR'];
        $login->login_at = date('Y-m-d H:i:s'); 
        $login->user_id = Auth::id(); 
        $login->save();

}




   protected function credentials(\Illuminate\Http\Request $request)
    {   Utility::stripXSS(); 

        //return $request->only($this->username(), 'password');
        return ['email' => $request->{$this->username()}, 'password' => $request->password, 'status' => 1];
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    public function logout(Request $request)
    {
        Utility::stripXSS(); 

        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/login');
    }



    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }




}
