<?php
namespace Hadefication\LaravelPreset;

use Illuminate\Support\ServiceProvider;

class LaravelPresetServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('laravelPreset', function () {
            return $this->app->make('Hadefication\LaravelPreset\LaravelPreset');
        });
    }

    /**
     * Boot
     *
     * @return void
     */
    public function boot()
    {
        // Add resources here...
    }
}
