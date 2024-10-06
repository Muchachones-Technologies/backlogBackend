<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class ApiRouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the route files for the API.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers\Api';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        $this->routes(function (){
            Route::middleware('api')
            ->prefix(('api'))
            ->group(base_path('routes/guest.php'));  
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
       
    }
}
