<?php

namespace Modules\Graybull\Providers;

use Illuminate\Support\ServiceProvider;

class GraybullServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $pathPrefix = base_path('Modules/Graybull');

        $this->loadRoutesFrom($pathPrefix . '/Routes/web.php');
        $this->loadMigrationsFrom($pathPrefix . '/Database/Migrations');
        $this->loadViewsFrom($pathPrefix . '/Resources/views', 'graybull');
        $this->mergeConfigFrom($pathPrefix . '/Config/graybull.php', 'graybull');
    }
}
