# NedoAuth

Nedo Authentication is a laravel library written in pure PHP and providing a set of classes that allow you to use Nedo Platform user authentication and authorization.

## Documentation

###### **Steps**:
  1. From the projects root folder, in the terminal, run composer to get the needed package.
     * Example:

      ```
         composer require sindika-id/nedo-auth
      ```
  2. From the projects root folder run ```composer update```
  3. Change config/auth.php use nedo user driver : 

        ```php
        ...

        'providers' => [
            'users' => [
                'driver' => 'nedo'
            ],
        ],

        ...
        ```

  4. This plugin will automatically make some controller and view related to authentication mechanism.
    
        - auth/login
        - auth/logout
        - auth/register
        - auth/forgotpass

  5. To get user information across all controller you can hook middleware :
        
      ```php
        namespace App\Http\Controllers;

        use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
        use Illuminate\Foundation\Bus\DispatchesJobs;
        use Illuminate\Foundation\Validation\ValidatesRequests;
        use Illuminate\Routing\Controller as BaseController;

        use Illuminate\Support\Facades\Auth;

        class Controller extends BaseController
        {
            use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

            protected $user;

            public function __construct()
            {
                $this->middleware(function ($request, $next) {
                    $this->user = Auth::user();
                    view()->share('user', $this->user);
                    return $next($request);
                });
            }
        }
      ```

  6. You can protect your page using laravel routers.
        * Example:
    
      ```php
        Route::group(['namespace' => 'Test', 'middleware' => ['notloggedin']], function () {
            Route::get('/', 'HomeController@index');
        });

        Route::group(['namespace' => 'Test', 'middleware' => ['loggedin']], function () {
            Route::get('/admin/', 'AdminController@index');
        });
        
      ```
  7. To publish view you can use vendor:publish command in terminal
      ```
        php artisan vendor:publish --provider=Nedoquery\Auth\NedoAuthServiceProvider
      ```

## License

Nedo Authentication is licensed under the [MIT license](https://opensource.org/licenses/MIT). Enjoy!
