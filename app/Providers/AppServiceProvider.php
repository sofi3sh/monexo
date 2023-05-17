<?php

namespace App\Providers;

use App\Http\Controllers\Backend\GlobalStatisticController;
use App\Http\Controllers\Backend\NewsController;
use App\Models\User;
use App\Observers\TransactionObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Console\Commands\ModelMakeCommand;
use Carbon\Carbon;
use App\Models\Home\Transaction;
use View;
use Illuminate\Contracts\Routing\UrlGenerator;
use App\Models\Home\MarketingPlan;

class AppServiceProvider extends ServiceProvider
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
     * @param UrlGenerator $url
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        Schema::defaultStringLength(191);
        if (config('app.https')) {
            $url->forceScheme('https');
        }

        Carbon::setLocale(app()->getLocale());

        $this->app->extend('command.model.make', function ($command, $app) {
            return new ModelMakeCommand($app['files']);
        });

        Transaction::observe(TransactionObserver::class);
        User::observe(UserObserver::class);

        // Вне личного кабинета
        View::composer('dinway.chunks.news', 'App\Http\ViewComposers\NewsViewComposer');
        View::composer('dinway.chunks.companyMaterials', 'App\Http\ViewComposers\CompanyMaterialsViewComposer');
        View::composer('dinway.chunks.header', 'App\Http\ViewComposers\Dinway\DinwayHeaderViewComposer');

        // Личный кабинет
        View::composer('dashboard.chunks.aside', 'App\Http\ViewComposers\Backend\AsideViewComposer');
        View::composer('dashboard.chunks.news', 'App\Http\ViewComposers\NewsViewComposer');
        View::composer('dashboard.modal-debts-info', 'App\Http\ViewComposers\ModalDebtsInfoViewComposer');

    }
}
