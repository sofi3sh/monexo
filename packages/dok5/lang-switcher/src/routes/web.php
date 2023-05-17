<?php

use Dok5\LangSwitcher\LanguageController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Switch between the included languages
Route::get('lang/{lang}', [LanguageController::class, 'swap'])->middleware('web');