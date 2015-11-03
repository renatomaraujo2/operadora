<?php

namespace Renatomaraujo2\Operadora;

use Illuminate\Support\ServiceProvider;

class OperadoraServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        /*if (! $this->app->routesAreCached())
        {
            include __DIR__.'/routes.php';
        }*/

        #$this->app->make('Renatomaraujo2\Operadora\OperadoraController');

        $this->app->singleton('operadora', function()
        {
            return new  \Renatomaraujo2\Operadora\Operadora;
        });
    }
}
