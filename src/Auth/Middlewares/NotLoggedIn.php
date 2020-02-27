<?php

namespace Nedoquery\Auth\Middlewares;

use Auth, Closure;

class NotLoggedIn {

    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            
        }
        
        return $next($request);
    }
}