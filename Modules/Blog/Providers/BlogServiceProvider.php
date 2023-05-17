<?php

namespace Modules\Blog\Providers;

use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $pathPrefix = base_path('Modules/Blog');

        $this->loadMigrationsFrom($pathPrefix . '/Database/Migrations');
    }
}
