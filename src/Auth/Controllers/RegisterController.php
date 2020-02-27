<?php

namespace Nedoquery\Auth\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
       
    }
    
    public function getRegister(){
        return view("nedo::register");
    }
    
    public function postRegister(Request $request){
        
        $credentials = $request->only(['username', 'email', 'captcha']);
        
        $validator = Validator::make($credentials, [
            'username' => 'required',
            'email' => 'required|email',
            'captcha' => 'required|captcha',
        ]);
        
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        
        
    }
}