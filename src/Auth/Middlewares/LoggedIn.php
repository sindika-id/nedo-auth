<?php
namespace Nedoquery\Auth\Middlewares;

use Auth, Closure;

class LoggedIn {

    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/auth/login');
        }
        
        return $next($request);
    }

}