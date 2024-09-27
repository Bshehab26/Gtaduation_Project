<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    //redirectTo home
    // protected $redirectTo = '/home';

    //redirectTo dashboard
    // protected $redirectTo = '/';
    protected $redirectTo = '/dashboard';



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    // public function logout()
    public function logout(Request $request)
    {
        $username=auth()->user()->name;
        Auth::logout();
        // return redirect()->route('dashboard-home');
        return redirect()->route('dashboard-home')->With('loggedout',"$username you have successfuly logged out.");
    }
}
