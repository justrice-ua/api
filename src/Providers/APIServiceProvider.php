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
            return new Core(config('justrice.api_url'),config('justrice.api_token'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/justrice.php' => config_path('justrice.php'),
        ]);
    }
}
