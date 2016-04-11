<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->composeSidebar();
        //$this->composeSettings();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }

    private function composeSidebar()
    {

    }
}
