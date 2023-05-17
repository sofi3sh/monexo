<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Modules\Graybull\Http\Controllers')
    ->middleware(['web', 'auth', '2fa'])
    ->prefix('graybull')
    ->group(function () {
        Route::get('game', 'ViewController@getView')
            ->name('game.graybull.index');

        Route::get('{any}', 'ViewController@getView')
            ->where('any', 'history|statistic');

        Route::prefix('game')->group(function () {
            Route::get('get-rules', 'GameController@getRules');
            Route::get('get-active-bet', 'GameController@getActiveBet');
            Route::get('get-bet-history', 'GameController@getBetHistory');
            Route::get('get-bonus-history', 'GameController@getBonusHistory');
            Route::get('get-game-statistics', 'GameController@getGameStatistics');
            Route::get('get-exchange-rate', 'GameController@getExchangeRate');
            Route::get('get-user-data', 'GameController@getUserData');
            Route::get('get-chart-data', 'GameController@getChartData');
            Route::post('make-bet', 'GameController@makeBet');
            Route::post('close-active-bet', 'GameController@closeActiveBet');
        });
    });
