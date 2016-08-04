<?php

namespace App\Providers;

use App\Region;
use Illuminate\Support\ServiceProvider;
use App\Helpers\RegionController;
class RegionProvider extends ServiceProvider
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
        $this->app->bind('App\Helpers\RegionContract', function(){
            return new RegionController();
        });
    }
}
