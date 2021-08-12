<?php

namespace Apachish\AccessLevel;

use Apachish\AccessLevel\App\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\Eloquent\Factories\Factory as EloquentFactory;

class AccessLevelServiceProvider extends ServiceProvider
{

    protected $commands = [

    ];

    public function register()
    {
    
        $this->mergeConfigFrom(__DIR__.'/Config/errors.php','errors');
        $this->commands($this->commands);
    }

    public function boot()
    {
//        $this->app->make(EloquentFactory::class)->load(__DIR__ . '/Database/Factories');
        $this->publishes([
            __DIR__.'/Database/Factories/User.php' => database_path('factories/User.php')
        ],'user-factory');
        $this->publishes([
            __DIR__.'/Database/Factories/User.php' => database_path('factories/User.php')
        ],'user-factory');
        $this->loadDependencies()
            ->publishDependencies();
        $this->app->booted(function (){
            $schedule = $this->app->make(Schedule::class);
        });
    }

    private function loadDependencies()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');

        $this->loadRoutesFrom(__DIR__ . '/routes/api.php');

        $this->loadViewsFrom(__DIR__.'/resources/views','access-level');

        return $this;
    }

    private function publishDependencies(){

        $this->publishes([
            __DIR__.'/Database/Migrations' => database_path('/migrations')
        ], 'access-level-migration');

        $this->publishes([
            __DIR__.'/Config/errors.php' => config_path('errors.php'),
        ],'access-level-config');

        $this->publishes([
            __DIR__.'/resources/views' => base_path('/resources/views/access-level')
        ],'access-level-views');

        $this->publishes([
            __DIR__ . '/Database/Seeds' => database_path('seeds'),
        ], 'access-level-seeds');

    }

}
