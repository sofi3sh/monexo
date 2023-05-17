<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['backend.pages.main','dashboard.*'], 'App\Http\ViewComposers\Backend\MainPageViewComposer');
        View::composer('backend.pages.invest', 'App\Http\ViewComposers\Backend\InvestPageViewComposer');
    }
}
