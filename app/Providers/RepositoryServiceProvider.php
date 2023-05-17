<?php

namespace App\Providers;

use App\Repositories\Suggestion\SuggestionRepository;
use App\Repositories\Suggestion\SuggestionRepositoryInterface;
use App\Repositories\SuggestionType\SuggestionTypeRepositoryInterface;
use App\Repositories\SuggestionType\SuggestionTypeTypeRepository;
use App\Repositories\UserIp\UserIpRepository;
use App\Repositories\UserIp\UserIpRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserIpRepositoryInterface::class, UserIpRepository::class);
        $this->app->bind(SuggestionRepositoryInterface::class, SuggestionRepository::class);
        $this->app->bind(SuggestionTypeRepositoryInterface::class, SuggestionTypeTypeRepository::class);
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
