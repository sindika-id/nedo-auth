<?php

namespace Nedoquery\Auth\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
       
    }
    
    public function getForgotPass(){
        return view("nedo::forgotpassword");
    }
    
    public function postForgotPass(Request $request){
        
        $credentials = $request->only(['email']);
        
        $validator = Validator::make($credentials, [
            'email' => 'required|email'
        ]);
        
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        
    }
}