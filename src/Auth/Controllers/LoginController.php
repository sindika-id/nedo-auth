<?php

namespace Nedoquery\Auth\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
       
    }
    
    public function getLogin(){
        return view("nedo::login");
    }
    
    public function postLogin(Request $request){
        $credentials = $request->only(['username', 'password']);
        
        $validator = Validator::make($credentials, [
            'username' => 'required',
            'password' => 'required',
        ]);
        
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        if (Auth::attempt($credentials)) {
            return redirect($this->redirectTo);
        }
        else {
            return Redirect::back()->withInput()->withErrors('Invalid username or password.');
        }
    }
    
    public function getLogout(){
        Auth::logout();
        return redirect($this->redirectTo);
    }
}
