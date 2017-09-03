<?php

namespace MattRink\ModelFormMaker;

use Illuminate\Support\ServiceProvider;

class ModelFormMakerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/modelformmaker.php' => config_path('modelformmmaker.php'),
        ], 'config');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {

    }
}