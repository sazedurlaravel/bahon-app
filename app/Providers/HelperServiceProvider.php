<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind('MdlSmsHelper', \App\Helpers\MdlSmsHelper::class);
        
        app()->bind('WalletHelper', \App\Helpers\WalletHelper::class);

        app()->bind('FileStorageHelper', \App\Helpers\FileStorageHelper::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
