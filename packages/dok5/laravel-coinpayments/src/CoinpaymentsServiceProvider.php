<?php

namespace Dok5\Coinpayments;

use Illuminate\Support\ServiceProvider;

class CoinpaymentsServiceProvider extends ServiceProvider
{
    /** @var string */
    private $configFileName = 'coinpayments.php';

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Load the default config values
        $configFile = $this->getConfigPath() . $this->configFileName;
        $this->mergeConfigFrom($configFile, 'coinpayments');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            $this->getFullConfigPath() => config_path($this->configFileName),
        ]);
    }

    /**
     * Get config path.
     *
     * @return string
     */
    protected function getConfigPath()
    {
        return __DIR__ . '/../config/';
    }

    /**
     * Get config file full path.
     *
     * @return string
     */
    protected function getFullConfigPath()
    {
        return $this->getConfigPath() . $this->configFileName;
    }
}
