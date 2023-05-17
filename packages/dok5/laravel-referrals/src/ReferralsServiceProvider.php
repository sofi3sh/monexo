<?php

namespace Dok5\Referrals;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Filesystem\Filesystem;

class ReferralsServiceProvider extends ServiceProvider
{
    /** @var string */
    private $configFileName = 'referrals.php';

    /** @var string */
    private $migrationFileName = 'add_referral_code_to_users_table.php';

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Load the default config values
        $configFile = $this->getConfigPath() . $this->configFileName;
        $this->mergeConfigFrom($configFile, 'referrals');
    }

    /**
     * Bootstrap services.
     *
     * @param Filesystem $filesystem
     * @return void
     */
    public function boot(Filesystem $filesystem)
    {
        $this->registerMiddleware();

        // Публикация русурсов
        $this->publishes([
            __DIR__ . '/../config/' . $this->configFileName => config_path($this->configFileName),
        ], 'config');
        $this->publishes([
            $this->getMigrationsPath() . $this->migrationFileName . '.stub' => $this->getMigrationFileName($filesystem),
        ], 'migrations');
    }

    /**
     *  Register middleware.
     *
     * @return void
     */
    public function registerMiddleware()
    {
        $this->app['router']->pushMiddlewareToGroup('web', CheckReferral::class);
    }

    /**
     * Get the migrations path.
     *
     * @return string
     */
    protected function getMigrationsPath()
    {
        return __DIR__ . '/database/migrations/';
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
     * Returns existing migration file if found, else uses the current timestamp.
     *
     * @param Filesystem $filesystem
     * @return string
     */
    protected function getMigrationFileName(Filesystem $filesystem): string
    {
        $timestamp = date('Y_m_d_His');

        return Collection::make($this->app->databasePath() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem) {
                return $filesystem->glob($path . "*_$this->migrationFileName");
            })->push($this->app->databasePath() . "/migrations/{$timestamp}_$this->migrationFileName")
            ->first();
    }

}
