<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
     // \Config::set('auth.defaults.guard','admin');

        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, $user)
    {
      // dd($user);
        if (!$user->verified) {
            auth()->logout();
          $msg = 'Resend';
            return back()->with('warning', "You need to confirm your account. We have sent you an activation code, please check your email.")
            ->with('link', $msg)
            ->with('user_id',$user->id);



        }
        return redirect()->intended($this->redirectPath());
    }

}