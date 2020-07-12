<?php

namespace Nedoquery\Auth\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Nedoquery\Api\NedoRequest;

class ForgotPasswordController extends Controller
{
    
    /**
     * @var Nedoquery\Api\NedoRequest
     */
    protected $nedoRequest;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(NedoRequest $nedoRequest) {
        $this->nedoRequest = $nedoRequest;
    }
    
    public function getForgotPass(){
        return view("nedo::forgotpassword");
    }
    
    public function getNewPass($token){
        return view("nedo::newpassword", compact('token'));
    }
    
    public function postNewPass(Request $request){
        $validator = Validator::make($request->all(), [
            'secret' => 'required',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }

    public function postForgotPass(Request $request){
        
        $credentials = $request->only(['email']);
        
        $validator = Validator::make($credentials, [
            'email' => 'required|email'
        ]);
        
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        
        $result = $this->nedoRequest->request('auth/recover.json', [
            'email' => $credentials['email'],
            'target_url' => url('/auth/recover')
        ], [], TRUE);
        
        if ($result->success){
            return view("nedo::forgotpassword-finish");
        }
        else{
            return Redirect::back()->withInput()->withErrors($validator)->withErrors(
                'Email tidak ditemukan'
            );
        }
    }
}