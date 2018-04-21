<?php

namespace Geeky\File;

use Illuminate\Support\ServiceProvider;

class FileServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->make(FileController::class);

        $this->publishes([
            __DIR__ . '/config/filesuploader.php' => config_path('filesuploader'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/filesuploader.php', 'filesuploader'
        );
    }
}
