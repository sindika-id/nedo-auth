<?php

namespace Nedoquery\Auth\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use Nedoquery\Api\NedoRequest;

class RegisterController extends Controller
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
        
        $config = $this->nedoRequest->getConfig();
        $user_type = $config['user_type'];
        
        $result = $this->nedoRequest->request('auth/register.json', [
            'usename' => $credentials['username'],
            'email' => $credentials['email'],
            'target_url' => url('/'),
            'usertype' => $user_type
        ], [], TRUE);
        
        if ($result->success){
            return view("nedo::register-finish");
        }
        else{
             return Redirect::back()->withInput()->withErrors($validator)->withErrors(
                $result->message
            );
        }
    }
}