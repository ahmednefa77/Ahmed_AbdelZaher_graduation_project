<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Providers\RouteServiceProvider;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

   public function authenticated(Request $request)
   {
       $record=new Profile();
       $record->user_id=Auth::user()->id;
       $record->save();
       session(['role'=>Auth::user()->role]);
       switch (session('role'))
       {
           case ("Admin"):return view("auth.Admin.dashboard");break;
           case ("User"):return view("userprofile");break;
           case ("Moderator"):return view("auth.Admin.dashboard");break;


       }
       return "Allah Akbar";
   }

}
