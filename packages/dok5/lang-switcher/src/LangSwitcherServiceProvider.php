<?php

namespace Dok5\LangSwitcher;

use Illuminate\Support\ServiceProvider;

class LangSwitcherServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /** @var string */
    private $configKeyName = 'locale';

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom($this->getPackageRootPath() . 'src/routes/web.php');
        $this->loadViewsFrom($this->getFullViewPath(), 'LangSwitcher');

        $this->publishes([
            $this->getFullViewPath() => base_path('resources/views/vendor/Dok5/LangSwitcher')
        ], 'view');
        $this->publishes([
            $this->getFullConfigFileName() => config_path($this->configKeyName . '.php'),
        ], 'config');

        $this->mergeConfigFrom(
            $this->getFullConfigFileName(), $this->configKeyName
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMiddleware();
    }

    /**
     *  Register middleware.
     *
     * @return void
     */
    public function registerMiddleware()
    {
        $this->app['router']->pushMiddlewareToGroup('web', LocaleMiddleware::class);
    }

    /**
     * Get package root path.
     *
     * @return string
     */
    protected function getPackageRootPath()
    {
        return __DIR__ . '/../';
    }

    /**
     * Get full path to package config file.
     *
     * @return string
     */
    protected function getFullConfigFileName()
    {
        return $this->getPackageRootPath() . 'config/' . $this->configKeyName . '.php';
    }

    /**
     * Get full path to package view directory.
     *
     * @return string
     */
    protected function getFullViewPath()
    {
        return $this->getPackageRootPath() . 'src/resources/views/';
    }

}
