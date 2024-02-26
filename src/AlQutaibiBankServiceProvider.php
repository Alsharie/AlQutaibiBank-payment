<?php

namespace Alsharie\AlQutaibiBankPayment;

use Illuminate\Support\ServiceProvider;

class  AlQutaibiBankServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Config file
        $this->publishes([
            __DIR__ . '/../config/AlQutaibiBank.php' => config_path('AlQutaibiBank.php'),
        ]);

        // Merge config
        $this->mergeConfigFrom(__DIR__ . '/../config/AlQutaibiBank.php', 'AlQutaibiBank');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AlQutaibiBank::class, function () {
            return new AlQutaibiBank();
        });
    }
}