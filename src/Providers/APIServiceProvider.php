<?php
namespace Justrice\API\Providers;

use Illuminate\Support\ServiceProvider;
use Justrice\API\Services\Core;

class APIServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Core::class, function (){
            return new Core('https://example.com','test_token');
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
