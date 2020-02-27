<?php

namespace Nedoquery\Auth;

use Illuminate\Support\ServiceProvider;
use \Nedoquery\Api\NedoRequest;

class NedoAuthServiceProvider extends ServiceProvider
{
    protected $middleware = [
        'loggedin' => 'Nedoquery\Auth\Middlewares\LoggedIn',
        'notloggedin' => 'Nedoquery\Auth\Middlewares\NotLoggedIn',
    ];
    
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        \Auth::provider('nedo', function($app)
        {   
            $request = $app[NedoRequest::class];
            return new NedoAuthUserProvider($app['hash'], $request);
        });
        
        $router = $this->app['router'];
        foreach($this->middleware as $name => $class) {
           $router->pushMiddlewareToGroup($name, $class);
        }
        
        $this->loadViewsFrom(__DIR__.'/Auth/Views', 'nedo'); 
        $this->loadRoutesFrom(__DIR__.'/Auth/Routes/routes.php');
        
        $this->publishes([
            __DIR__.'/Auth/Views' => resource_path('views/vendor/nedo'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        
    }
}

