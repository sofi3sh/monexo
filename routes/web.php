<?php

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

// Маршруты сайта

use Illuminate\Support\Facades\Auth;
use Svg\Tag\Group;

Route::get('/ovtable', [\App\Http\Controllers\Backend\ObonusController::class, 'invest'])->name('ovtable');


Route::as('website.')
//    ->middleware(['cache.headers:private;max_age=36'])
//    ->middleware(['cache.control'])
    ->group(function () {
        Route::get('/flush', function () {
            Session::flush();
            return redirect('/login');
        })->name('flush');

        Route::prefix('news-unsubscribe')
            ->as('news-unsubscribe.')
            ->group(function() {
            Route::get('/', 'Backend\NewsEmailController@showUnsubscribeForm')->name('show');
            Route::delete('/delete', 'Backend\NewsEmailController@unsubscribe')->name('delete');
        });

        Route::get('/redirect', 'Auth\LoginController@redirectToProvider')->name('redirect.google');
        Route::get('/callback', 'Auth\LoginController@handleProviderCallback');
        Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs');
        Route::get('/open-deposit-email/{id}', 'Backend\OpenDepositController@openDepositFromEmail')->name('open-deposit-email');

        Route::middleware('referral')->group(function() {
            Route::get('/affiliate-program', 'FrontendController@newAffiliateProgram')->name('dinway-affiliate-program');
            Route::get('/blogtime', 'FrontendController@newBlogtime')->name('dinway-blogtime');
            Route::get('/businessgaming', 'FrontendController@newBusinessgaming')->name('dinway-businessgaming');
            Route::get('/businesspack', 'FrontendController@newBusinesspack')->name('dinway-businesspack');
            Route::get('/profi-universe', 'FrontendController@newEducation')->name('dinway-education');
            Route::get('/faq', 'FrontendController@newFAQ')->name('dinway-faq');
            Route::get('/faq/data', 'FrontendController@getFAQData')->name('dinway.faq.data');
            //Route::get('/', 'FrontendController@newIndex')->name('home');
            Route::get('/', 'FrontendController@monexoIndex')->name('home');
            Route::get('/investments', 'FrontendController@newInvestments')->name('dinway-investments');
            Route::get('/modals', 'FrontendController@newModals')->name('dinway-modals');
            Route::get('/blog', 'FrontendController@newBlog')->name('dinway-blog');
            Route::get('/blog-item', 'FrontendController@newBlogItem')->name('dinway-blog-item');
            Route::get('/agreement', 'FrontendController@newAgreement')->name('dinway-agreement');
            Route::get('/events', 'FrontendController@newEvents')->name('dinway-events');
            Route::post('/store-ticket', 'FrontendController@storeTicket')->name('store-ticket');
            Route::get('/regulations', 'FrontendController@showRegulationsPage')->name('regulations');
        });


        // Прием ответа от Payeer Merchant
        Route::get('/payment/payeer_ipn', '\App\Http\Controllers\API\PayeerController@getResult');
        Route::get('/payment/payeer_fail', '\App\Http\Controllers\API\PayeerController@error');
        Route::get('/payment/payeer_success', '\App\Http\Controllers\API\PayeerController@success');
        // Прием ответа от PerfectMoneymarketing-plans
        Route::match(array('GET','POST'),'/payment/pm_ipn', '\App\Http\Controllers\API\PMController@getResult');
        Route::match(array('GET','POST'),'/payment/pm_fail', '\App\Http\Controllers\API\PMController@getResult');
        Route::match(array('GET','POST'),'/payment/pm_success', '\App\Http\Controllers\API\PMController@getResult');
        // Вывод новостей
       Route::get('/news/list', 'FrontendController@newsList')->name('newsList');
       Route::get('/news/details/{id}', 'FrontendController@newsDetails')->name('newsDetails');


        //Forgot password
        Route::post('password-reset', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.reset');
        Route::get('withdraw_confirm', 'Backend\BackendController@showWithdrawConfirmForm')->name('withdraw.confirm');
        Route::post('/withdraw_verification', 'Backend\BackendController@verifyWithdrawalByCode')->name('withdraw.verification');
        Route::get('reset-password/{token}', 'Auth\ResetPasswordController@showResetForm');
        Route::post('reset-password/{token}', 'Auth\ResetPasswordController@resetPassword')->name('reset.password');
        Route::get('/verify-withdrawal/{id}', 'Backend\BackendController@verifyWithdrawal');

        // News subscribe
        Route::post('/news/subscribe', 'FrontendController@newsEmailSubscribe')->name('news-subscribe');
     });

    // Маршруты авторизации, регистрации и сброса пароля
    Auth::routes(['verify' => true]);

    // Верификация телефона
    Route::namespace('Auth')
        ->prefix('phone')
        ->group(function () {
            Route::get('verify', 'PhoneVerificationController@show')->name('verification.phone');
            Route::get('resend', 'PhoneVerificationController@resend')->name('verification.phone-resend');
            Route::patch('verify', 'PhoneVerificationController@verify')->name('verification.phone-verify');
            Route::get('add-phone', 'PhoneVerificationController@addPhoneForm')->name('register.add-phone-form');
            Route::patch('add-phone', 'PhoneVerificationController@addPhone')->name('register.add-phone');
        });

    // Верификация Telegram
    Route::namespace('Auth')
        ->prefix('telegram')
        ->group(function () {
            Route::get('verify', 'TelegramVerificationController@show')->name('verification.telegram');
            Route::get('verify-action', 'TelegramVerificationController@verify')->name('verification.telegram-action');
        });

    // Авторизация / Регистрация
    Route::namespace('Auth')
        ->group(function () {
            Route::get('login', 'LoginController@showLoginForm')->name('login');
            Route::get('register/{referral_deposit_id?}', 'RegisterController@showRegistrationForm')->name('register');
            Route::post('register', 'RegisterController@register')->name('register');
            Route::get('register-query-email', 'RegisterController@registerQueryEmail')->name('register.query.email');
            Route::post('cancel-registration', 'RegisterController@cancelRegistration')->name('cancel.registration');
            Route::get('logout', 'LoginController@logout');
            Route::get('reset-password', 'ResetPasswordController@showPasswordPage')->name('reset.password');
        });

    Route::get('/login/otp', [App\Http\Controllers\Auth\OTPController::class, 'show'])->name('otp.show');
    Route::post('/login/otp', [App\Http\Controllers\Auth\OTPController::class, 'check'])->name('otp.check');

    Route::post('/2faVerify', function () {
        return redirect(request()->session()->get('_previous')['url']);
    })->name('2faVerify')->middleware(['2fa', 'throttle']);

// Маршруты лк
Route::prefix('home')
    ->as('home.')
    ->middleware(['auth', '2fa', 'verifiedPhone', 'telegramAuth'])
    ->namespace('Backend')
    ->group(function () {
        // Тестовая страница
        Route::get('/test', 'TestController@index')->name('test');

        // Отображение страницы Главная
        Route::match(['get', 'post'], '/', 'BackendController@showMainPage')->name('main');

        // ------ Вывод ------
        // Отображение страницы Выводы
        Route::get('/withdrawals', 'TransactionsController@create')->name('withdrawal.create');
        // Создание заявки на вывод
        Route::post('/withdrawals', 'TransactionsController@storeRequestWithdrawal')->name('withdrawal.store');
        //  Удаление пользователем своей транзакции с заявкой на вывод
        Route::post('/delete_withdrawal_request/{transaction}', 'TransactionsController@deleteWithdrawalRequest')->name('withdrawal.delete');

        // Отображение страницы Транзакции
        Route::get('/transactions', 'Pages\TransactionsPageController@index')->name('transactions');
        Route::get('/business-partner', 'BackendController@showBusinessPartner')->name('business.partner');
        Route::get('/vacancies', 'BackendController@showVacancies')->name('vacancies');
        Route::get('/baunty', 'BackendController@showBaunty')->name('baunty');
        Route::post('/baunty-save-link', 'BackendController@saveBauntyLink')->name('baunty.save.link');
        Route::post('/baunty', 'BackendController@reportBaunty')->name('reportBaunty');

        Route::post('/change-telegram-id', 'BackendController@changeTelegramId')->name('changeTelegramId');
        Route::get('/alerts', 'AlertsController@index')->name('alerts');
        Route::get('/notifications', 'AlertsController@getNotifications')->name('notifications');
        Route::get('/text-button', 'AlertsController@getTextButton')->name('text.button');
        Route::get('/alerts-viewed/{id}', 'AlertsController@alertsMakeViewed')->name('alerts.viewed');

        // ------ Profi Universe ------
        Route::get('/profi-universe', 'BackendController@showProfiUniversePage')->name('profi-universe');
        Route::match(['get', 'post'], '/profi-universe/fetch-exam/{moduleId}', 'BackendController@fetchExam')->name('profi-universe.fetch-exam');
        Route::post('/profi-universe', 'BackendController@writeAnswer')->name('profi-universe.store');

        // Партнеры (старая реализация карты парнтеров)
        Route::namespace('Pages')
            ->prefix('partner')
            ->group(function () {
                Route::post('/regional-representative/create-request', 'PartnerController@createRegionalRepresentativeRequest')->name('partner.regional-representative.request.create');
                Route::post('/invitation-deposit/create', 'PartnerController@createInvitationDeposit')->name('partner.invitation-deposit.create');
            });

        // ------ Инвестиции ------
        // Отображение страницы Инвестировать
        Route::get('/balance', 'BackendController@showInvestPage')->name('balance');
        Route::post('/balance', 'BackendController@postInvestPage')->name('balance');

        Route::prefix('balance')
            ->as('balance.')
            ->group(function () {
                Route::get('/payment', 'BackendController@createPayment')->name('payment'); // пополнение
                Route::post('/payout', 'BackendController@createPayout')->name('payout');
                Route::post('/request-withdrawal', 'BackendController@requestWithdrawal')->name('request.withdrawal'); // вывод
                Route::post('/exchange', 'BackendController@exchange')->name('exchange'); // валютообмен
                Route::post('/rate-front', 'BackendController@getRateForFront')->name('rate-front'); // Получить курс валюты для фронта

                Route::get('payment/payeer/{id}', '\App\Http\Controllers\API\PayeerController@showPaymentForm')->name('payment.payeer');
                Route::get('payment/pm/{id}', '\App\Http\Controllers\API\PMController@showPaymentForm')->name('payment.pm');
                Route::post('send-pm', '\App\Http\Controllers\API\PMController@sendPM')->name('payment.send-pm');
                Route::get('payment/coin/{id}', '\App\Http\Controllers\API\CoinsController@showPaymentForm')->name('payment.coin');

                Route::post('payment/coin/request/{id}', '\App\Http\Controllers\API\CoinsController@sendRequest')->name('payment.coin.request');
                Route::get('/button-continue/{id}', 'BackendController@buttonContinue')->name('button-continue'); // пополнение
                Route::post('/dinway-wallet-withdrawal', 'DinwayWalletDebtUsdController@withdrawal')->name('dinway-wallet-withdrawal');
            });


        // ------ Услуги ------
        Route::prefix('services')
            ->as('services.')
            ->namespace('Service')
            ->group(function () {
                Route::get('/blogtime', 'ServicesController@blogtime')->name('blogtime');
                Route::get('/businesspack', 'ServicesController@businesspack')->name('businesspack');
                Route::get('/profi_universe', 'ServicesController@profiUniverse')->name('profi_universe');
                Route::post('booking', 'ServicesController@booking')->name('booking');
        });


        // ------ Маркетинговые планы ------
        Route::prefix('marketing-plans')
            ->as('marketing-plans.')
            ->namespace('Pages')
            ->group(function () {
                // Страница маркетинг-планов
                Route::get('/', 'MarketingPlanController@index')->name('index');
                // Купить план
                Route::post('/buy', 'MarketingPlanController@buy')->name('buy');
                // Инвестировать
                Route::post('/invest', 'MarketingPlanController@invest')->name('invest');
                Route::post('/invest-crypto', 'MarketingPlanController@investCrypto')->name('invest.crypto');
                Route::get('/withdraw', 'MarketingPlanController@withdrawPackageProfit')->name('invest.withdraw');
                // Закрыть план
                Route::post('/close', 'MarketingPlanController@close')->name('close');

                Route::post('/close-marketing-plan', 'MarketingPlanController@closePlanWithCommission')->name('close.with.commision');
                // Страница коина
                Route::get('/coin', 'MarketingPlanController@showCoinPage')->name('show-coin-page');
            });


        // Отображение страницы Рефералы
        Route::get('/referrals', 'BackendController@showReferralsPage')->name('referrals');
        Route::get('/about-referrals', 'BackendController@showAboutReferralsPage')->name('about-ref');

        Route::prefix('/referral/statistics')
                ->as('referral.statistic.')
                ->group(function() {
                    Route::get('/cities/user/{id}/level/{level}', '\App\Http\Controllers\API\ReferralStatisticChartControler@getCities')->name('cities');
                    Route::get('/partners/user/{id}/level/{level}', '\App\Http\Controllers\API\ReferralStatisticChartControler@getPartners')->name('partners');
                });
        Route::post('/referrals/referral-invite', 'ReferralInviteController@sendReferralInvite')->name('referral-invite');

        // ------ Отображение страницы Новости ------
//        Route::get('/news', 'Pages\NewsPageController@showNewsPage')->name('news');

        // Профиль
        Route::group([
            'namespace' => 'Profile',
            'prefix'    => 'profile',
            'as'        => 'profile.',
        ], function () {
            // Профиль
            // Отображение страницы Профиль
            Route::get('/', 'ProfileController@showProfilePage')->name('profile');
            Route::post('/personal' ,'ProfileController@personalUpdate')->name('personal');
            Route::post('/payments' ,'ProfileController@paymentsUpdate')->name('payments');
            Route::post('/password' ,'ProfileController@passwordUpdate')->name('password');
            Route::post('/send-sms' ,'ProfileController@sendPhoneVerificationSms')->name('send-sms');
            Route::post('/set-phone' ,'ProfileController@phoneUpdate')->name('phone');
            // Обновление Профиля
            Route::patch('/name-phone', 'ProfileController@patchProfilePage')->name('patch-name-phone');
            Route::patch('/avatar', 'ProfileController@patchProfileAvatar')->name('patch-avatar');
            Route::patch('/update-news-subscribe', 'ProfileController@updateNewsSubscribe')->name('patch-news');
            Route::patch('/update-parners-map-app', 'ProfileController@updatePartnersMapApp')->name('partners-map-update');

            // 2fa авторизация
            Route::post('/twofa-enable' ,'ProfileController@twofaEnable')->name('twofa-enable');
            Route::post('/twofa-disable' ,'ProfileController@twofaDisable')->name('twofa-disable');

            // Отображение страницы Смена пароля
            Route::get('/password', 'ProfileController@showChangePasswordPage')->name('password');
            // Обновление пароля
            Route::patch('/password', 'ProfileController@pathAuthUserPassword')->name('password.path');
            // Реквизиты платежных систем
            Route::get('/requisites', 'ProfileController@showRequisitesPage')->name('requisites-show');
            Route::post('/requisites', 'ProfileController@postRequisitesPage')->name('requisites-post');

            // Отображение страницы Управление 2FA
            Route::get('/2fa', 'PasswordSecurityController@show2faForm')->name('2fa');
            Route::post('/generate2faSecret', 'PasswordSecurityController@generate2faSecret')->name('generate2faSecret');
            Route::post('/2fa', 'PasswordSecurityController@enable2fa')->name('enable2fa');
            Route::post('/disable2fa', 'PasswordSecurityController@disable2fa')->name('disable2fa');

            // Маршруты сброса пароля
            Route::get('/show-email-reset', 'EmailResetController@index')->name('show-email-reset');
            Route::post('/send-email', 'EmailResetController@sendMail')->name('send-email');
            Route::get('/email-reset/{token}', 'EmailResetController@resetEmail')->name('email-reset');



            // api
            /*Route::group(['prefix' => 'api/profile'], function () {
                Route::get('/getAuthUser', 'ProfileController@getAuthUser');
                Route::put('/updateAuthUser', 'ProfileController@updateAuthUser');
                Route::put('/updateAuthUserPassword', 'ProfileController@updateAuthUserPassword');
            });*/
        });

        // Отображение страницы FAQ
        Route::get('/faq', 'BackendController@showFaqPage')->name('faq');

        //Форма обратной связи в лк
        Route::post('/feedback', 'BackendController@sendFeedbackForm')->name('send-feedback-form');

        Route::get('/partners-map', 'BackendController@showPartnersMapPage')->name('partners-map');

        Route::post('/partners-emails', 'PartnersEmailsController@sendAll')->name('partners-emails');


        Route::namespace('\Modules\Blog\Http\Controllers')
            ->as('blog.')
            ->prefix('blog')
            ->group(function () {
                Route::redirect('', 'blog/post');
                Route::resource('post', 'PostController', ['only' => ['index', 'show']]);
            });

        Route::get('/ticket', 'TicketController@index')->name('ticket');
        Route::get('/ticket/create', 'TicketController@create')->name('ticket.create');
        Route::post('/ticket/store', 'TicketController@store')->name('ticket.store');
        Route::get('/ticket/correspondence', 'TicketController@getCorrespondence')->name('ticket.correspondence');
        Route::get('/ticket/add-answer', 'TicketController@addAnswer')->name('ticket.add-answer');

        Route::get('/ticket/template/create', 'TicketController@createTemplate')->name('ticket.create.template');
        Route::post('/ticket/store/template', 'TicketController@storeTemplate')->name('ticket.store.template');
        Route::post('/ticket/destroy/template/{responseTemplate}', 'TicketController@destroyTemplate')->name('ticket.destroy.template');
        Route::get('/ticket/edit/template/{responseTemplate}', 'TicketController@editTemplate')->name('ticket.edit.template');
        Route::get('ticket/{ticket_id}/set-viewed', 'TicketController@setViewed')->name('ticket.set-viewed');

        Route::get('/debts-info', 'DinwayDebtsController@index')->name('debts-info');

        // Карта партнеров
        Route::prefix('/partners-map-buy')
              ->as('partners-map-buy.')
              ->group(function() {
                Route::patch('/', 'BuyPartnersMapController@createApp')->name('create-app');
              });

        // Пожелания и предложения (цели)
        Route::prefix('suggestions')
            ->as('suggestions.')->group(function() {
                Route::get('/', 'SuggestionController@index')->name('index');
                Route::get('/create', 'SuggestionController@create')->name('create');
                Route::get('/edit/{id}', 'SuggestionController@edit')->name('edit');
                Route::post('/', 'SuggestionController@store')->name('store');
                Route::patch('/like/{id}', 'SuggestionController@like')->name('like');
                Route::patch('/dislike/{id}', 'SuggestionController@dislike')->name('dislike');
                Route::patch('/unlike/{id}', 'SuggestionController@unlike')->name('unlike');
                Route::put('/{id}', 'SuggestionController@update')->name('update');
                Route::delete('/{id}', 'SuggestionController@destroy')->name('delete');
            });

        // Регламенты
        Route::get('/regulations', 'RegulationsController@index')->name('regulations');

        // Страница материалов
        Route::get('/materials', 'BackendController@showMaterialsPage')->name('materials');

        // api
        Route::get('/get-locale', 'SettingsController@getLocale')->name('get-locale');
        // Анкета на верификаци.
        Route::post('/verif', 'VerifAnketAnswerController@store')->name('verif.store');

    });

// Маршруты админки
Route::prefix('tt-admin')
    ->as('admin.')
    ->middleware(['auth', '2fa', 'admin'])
    ->namespace('Admin')
    ->group(function () {
        Route::get('/', 'AdminController@showMainPage')->name('main');
        Route::get('/clients', 'AdminController@showClientsPage')->name('clients');
        Route::get('/client/{id}', 'AdminController@showClientPage')->name('client');
        Route::post('/client/{user}/blocked', 'AdminController@blockedClient')->name('client.blocked');
        Route::get('/client/login-as-client/{user}', 'AdminController@loginAsClient')->name('client.login_as_client');
        Route::post('/client/{user}/toggle-status/{status}', 'AdminController@toggleStatus')->name('client.toggle_status');
        Route::post('/replenish-balance/{id}', 'AdminController@replenishBalance')->name('replenish-balance');
        Route::post('/replenish-bonuses/{id}', 'AdminController@replenishBonuses')->name('replenish-bonuses');
        Route::get('/withdrawal-requests', 'AdminController@showWithdrawalRequestsPage')->name('withdrawal-requests');
        Route::get('/withdrawal-requests-all', 'AdminController@withdrawalRequestsAll')->name('withdrawal-requests-all');
        Route::get('/crypto-requests', 'AdminController@showCryptoRequestsPage')->name('crypto-requests');
        Route::post('/confirm_crypto/{id}', 'AdminController@confirmCrypto')->name('confirm-crypto');
        Route::post('/delete_confirm_crypto/{id}', 'AdminController@deleteConfirmCrypto')->name('delete-confirm-crypto');
        Route::get('/client/packages-statistics/{email}', 'AdminController@showUserPackagesStatisticsPage')->name('client.packages-statistics');
        Route::get('/client/verify/{email}', 'VerifAnketAnswerController@client')->name('client.verify');

        Route::prefix('partner')
            ->group(function () {
                Route::get('/regional-representative/requests', 'AdminController@regionalRepresentativeRequests')->name('partner.regional-representative.request.index');
                Route::post('/regional-representative/confirm-request/{request}', 'AdminController@confirmRegionalRepresentativeRequest')->name('partner.regional-representative.request.confirm');
                Route::post('/regional-representative/reject-request/{request}', 'AdminController@rejectRegionalRepresentativeRequest')->name('partner.regional-representative.request.reject');

                Route::get('/invitation-deposits', 'AdminController@invitationDeposits')->name('partner.invitation-deposit.index');
            });

        Route::post('revert-can-withdrawal-crypto', 'AdminController@revertCanWithdrawalCrypto')->name('revert-can-withdrawal-crypto');
        Route::post('revert-can-withdrawal-status', 'AdminController@revertCanWithdrawalStatus')->name('revert-can-withdrawal-status');
        Route::get('/accruals', 'AdminController@showAccrualsPage')->name('accruals');
        Route::get('/system', 'AdminController@showSystemPage')->name('system');
        Route::get('/stats', 'AdminController@showStatsPage')->name('stats');
        Route::post('/confirm_withdrawal/{id}', 'AdminController@confirmWithdrawal')->name('confirm-withdrawal');
        Route::post('/delete_confirm_withdrawal/{id}', 'AdminController@deleteConfirmWithdrawal')->name('delete-confirm-withdrawal');
        Route::post('/email-verified/{user}', 'AdminController@emailVerified')->name('email-verified');
        Route::post('/disable-2fa/{user}', 'AdminController@disable2Fa')->name('disable-2fa');
        Route::post('/change-fake/{user}', 'AdminController@changeFake')->name('change-fake');
        Route::post('/create-transaction/{transaction}', 'AdminController@createTransaction')->name('create-transaction');
        Route::post('/create-accruals', 'AdminController@createFakeAccrual')->name('create-accruals');
        Route::post('/change-ancestor', 'AdminController@changeAncestor')->name('change-ancestor');
        Route::delete('/delete-transaction/{transaction}', 'AdminController@deleteTransaction')->name('delete-transaction');
        // Новости сайта
        Route::get('/news', 'NewsController@showNewsPage')->name('news');
        Route::get('/news/edit/{id}', 'NewsController@showEditNewsPage')->name('newsEdit');
        Route::get('/news/create', 'NewsController@createNews')->name('newsCreate');
        Route::post('/news/store','NewsController@storeNews')->name('storeNews');
        Route::delete('/news/delete/{id}', 'NewsController@deleteNews')->name('newsDelete');
        // Новости сайта
        Route::get('/baunty', 'BauntyController@showPage')->name('baunty');
        Route::get('/baunty/edit/{id}', 'BauntyController@showEditPage')->name('bauntyEdit');
        Route::get('/baunty/create', 'BauntyController@create')->name('bauntyCreate');
        Route::post('/baunty/store','BauntyController@store')->name('storeBaunty');
        Route::delete('/baunty/delete/{id}', 'BauntyController@delete')->name('bauntyDelete');
        // Ссылки
        Route::get('/links', 'BauntyController@showLinks')->name('links');
        Route::post('/confirm-links/{id}', 'BauntyController@confirmLinks')->name('confirm.links');
        Route::post('/cancel-links/{id}', 'BauntyController@cancelLinks')->name('cancel.links');

        // Услуги
        Route::get('/services', 'AdminServicesController@index')->name('services');

        // Вопросы для видеоуроков
        Route::get('/mlmup2question', 'AdminQuestionController@index')->name('mlmup2question');
        Route::get('/mlmup2question/create', 'AdminQuestionController@create')->name('mlmup2question.create');
        Route::get('/mlmup2question/{question}/edit', 'AdminQuestionController@edit')->name('mlmup2question.edit');
        Route::post('/mlmup2question', 'AdminQuestionController@store')->name('mlmup2question.store');
        Route::post('/mlmup2question/{question}', 'AdminQuestionController@destroy')->name('mlmup2question.destroy');


        // Ответы для видеоуроков
        Route::match(['get', 'post'],'/mlmup2answer', 'AnswerController@index')->name('mlmup2answer');


        Route::get('/mlmup2question/edit/{question}', 'AdminQuestionController@edit')->name('mlmup2question.edit');

//        Route::get('/baunty/edit/{id}', 'BauntyController@showEditPage')->name('bauntyEdit');
//        Route::get('/{bid}/edit', ['as' => 'bid.edit', 'uses' => 'App\Http\Controllers\BidController@edit']);


        // Инвертирует тип аккаунта между обычным и трейдинг
        Route::post('/invertAccountType/{id}', 'AdminController@invertAccountType')->name('invert-account-type');
        Route::any('/transfers-between-accounts', 'AdminController@transferBetweenAccounts')->name('transfers-between-accounts');
        // Системные параметры
        Route::post('/set-manual-accrual-percents', 'AdminController@setManualAccrualPercents')->name('set-manual-accrual-percents');
        // ---- Статистика ----------
        Route::prefix('g-stat')
            ->as('g-stat.')
            ->group(function () {
                // Отображение страницы статистики
                Route::get('/index', 'AdminGlobalStatisticController@index')->name('index');
                Route::post('/update', 'AdminGlobalStatisticController@store')->name('update');
            });

        // FAQ
        Route::namespace('FAQ')
            ->as('faq.')
            ->prefix('faq')
            ->group(function () {
                Route::get('', 'ViewController@index')->name('index');
                Route::resource('question', 'QuestionController', ['except' => ['index', 'show']]);
                Route::resource('category', 'CategoryController', ['except' => ['index', 'show']]);
                Route::get('questions/datatable', 'QuestionController@getTableData')->name('datatable.questions');
                Route::get('categories/datatable', 'CategoryController@getTableData')->name('datatable.categories');
            });

        // События
        Route::namespace('Events')
            ->as('events.')
            ->prefix('events')
            ->group(function () {
                Route::get('', 'ViewController@index')->name('index');
                Route::resource('event', 'EventController', ['except' => ['index', 'show']]);
                Route::get('/datatable', 'EventController@getTableData')->name('datatable.events');

        });

        // Материалы компании
        Route::namespace('CompanyMaterials')
            ->as('companyMaterials.')
            ->prefix('companyMaterials')
            ->group(function () {
                Route::get('', 'ViewController@index')->name('index');
                Route::resource('companyMaterial', 'CompanyMaterialController', ['except' => ['index', 'show']]);
                Route::get('/datatable', 'CompanyMaterialController@getTableData')->name('datatable.companyMaterials');

            });

        // Партнеры (старая реализация карты партнетов)
        Route::resource('partner', 'PartnerController');
        Route::get('partners/datatable', 'PartnerController@getTableData')->name('datatable.partners');

        // Карта партнеров
        Route::prefix('partners-map')
        ->as('partners-map.')
        ->group(function() {
            Route::get('/', 'MapController@index')->name('index');
            Route::get('/edit', 'MapController@edit')->name('edit');
            Route::post('/update', 'MapController@update')->name('update');
            Route::prefix('/buy')
            ->as('buy.')
            ->group(function() {
                Route::get('/index', 'BuyPartnersMapController@index')->name('index');
                Route::get('/edit', 'BuyPartnersMapController@edit')->name('edit');
                Route::post('/update', 'BuyPartnersMapController@update')->name('update');
                Route::delete('/delete', 'BuyPartnersMapController@delete')->name('delete');
                Route::patch('/change-status', 'BuyPartnersMapController@changeStatus')->name('change-status');
                Route::post('/refuse', 'BuyPartnersMapController@refuse')->name('refuse');
                Route::prefix('/datatable')
                        ->as('datatable.')
                        ->group(function() {
                            Route::get('/all', 'BuyPartnersMapController@dataTableAll')->name('all');
                            Route::get('/done', 'BuyPartnersMapController@dataTableDone')->name('done');
                            Route::get('/not-done', 'BuyPartnersMapController@dataTableNotDone')->name('not-done');
                            Route::get('/end-of-sub', 'BuyPartnersMapController@dataTableEndOfSub')->name('end-of-sub');
                });
            });
        });

        // Покупка места на карте партнёров
        Route::prefix('partners-map')->group(function() {
            Route::get('/', 'MapController@index')->name('partners-map.index');
            Route::get('/edit', 'MapController@edit')->name('partners-map.edit');
            Route::post('/update', 'MapController@update')->name('partners-map.update');
        });

        // Блог
        Route::namespace('\Modules\Blog\Http\Controllers\Admin')
            ->as('blog.')
            ->prefix('blog')
            ->group(function () {
                Route::resource('', 'BlogController', ['only' => 'index']);
                Route::resource('post', 'PostController', ['except' => ['index', 'show']]);
                Route::resource('category', 'CategoryController', ['except' => ['index', 'show']]);
                Route::resource('tag', 'TagController', ['except' => ['index', 'show']]);
                Route::get('posts/datatable', 'PostController@getTableData')->name('datatable.posts');
                Route::get('categories/datatable', 'CategoryController@getTableData')->name('datatable.categories');
                Route::get('tags/datatable', 'TagController@getTableData')->name('datatable.tags');
            });

        // Цитаты
        Route::resource('quote', 'QuoteController', ['except' => ['show']]);
        Route::get('quotes/datatable', 'QuoteController@getTableData')->name('datatable.quotes');

        // ip-адреса пользователей
        Route::get('/user-ip', 'UserIpController@index')->name('user-ip');
        Route::get('/user-ip-search', 'UserIpController@searchIp')->name('user-ip-search');

        // Пользовательские переводы
        Route::get('/custom-Transaction', 'CustomTransactionController@index')->name('customTransaction.main');
        Route::get('/custom-Transaction/edit', 'CustomTransactionController@edit')->name('customTransaction.edit');
        Route::post('/custom-Transaction/update', 'CustomTransactionController@update')->name('customTransaction.update');

        // Информация о моментальном выводе
        Route::get('/withdrawalModalInfo', 'InstantWithdrawalInfoController@index')->name('withdrawalModalInfo.index');
        Route::get('/withdrawalModalInfo/edit', 'InstantWithdrawalInfoController@edit')->name('withdrawalModalInfo.edit');
        Route::post('/withdrawalModalInfo/update', 'InstantWithdrawalInfoController@update')->name('withdrawalModalInfo.update');

        // Тикеты саппорт
        Route::get('/ticket-support', 'TicketSupportController@index')->name('ticket-support');
        Route::get('/ticket-support/responsible', 'TicketSupportController@getResponsible')->name('ticket-support.responsible');
        Route::get('/ticket-support/{ticket}/edit', 'TicketSupportController@edit')->name('ticket-support.edit');
        Route::post('/ticket-support/{ticket}/destroy', 'TicketSupportController@destroy')->name('ticket-support.destroy');
        Route::post('/ticket-support', 'TicketSupportController@store')->name('ticket-support');
        Route::post('/ticket-support/change-status', 'TicketSupportController@changeStatus')->name('ticket-support.change-status');

        // Шаблоны тикетов
        Route::prefix('response-template')->group(function() {
            Route::get('', ['as' => 'response-template.index', 'uses' => 'TicketTemplateController@index']);
            Route::post('', ['as' => 'response-template.store', 'uses' => 'TicketTemplateController@store']);
            Route::get('/create', ['as' => 'response-template.create', 'uses' => 'TicketTemplateController@create']);
            Route::get('/{responseTemplate}/edit', ['as' => 'response-template.edit', 'uses' => 'TicketTemplateController@edit']);
            Route::post('/{responseTemplate}', ['as' => 'response-template.destroy', 'uses' => 'TicketTemplateController@destroy']);
        });
        // Тикеты с фронта
        Route::prefix('ticket-front')->group(function() {
            Route::post('/{ticketFront}', ['as' => 'ticket-front.destroy', 'uses' => 'TicketTemplateController@destroyTicketFront']);
            Route::get('/{ticketFront}/edit', ['as' => 'ticket-front.edit', 'uses' => 'TicketTemplateController@editTicketFront']);
            Route::post('', ['as' => 'ticket-front.store', 'uses' => 'TicketTemplateController@storeTicketFront']);
        });

        // Новостная подписка
        Route::prefix('news-subscribes')
                ->as('news-subscribes.')->group(function() {
                    Route::get('/', 'NewsEmailController@index')->name('index');
                    Route::get('/edit', 'NewsEmailController@edit')->name('edit');
                    Route::post('/update', 'NewsEmailController@update')->name('update');
                    Route::get('/csv-emails', 'NewsEmailController@emailsCsv')->name('emails-csv');
                });

        // Типы пожеланий и предложений
        Route::prefix('suggestion-types')
            ->as('suggestion-types.')->group(function() {
                Route::get('/', 'SuggestionTypeController@index')->name('index');
                Route::get('/create', 'SuggestionTypeController@create')->name('create');
                Route::get('/edit/{id}', 'SuggestionTypeController@edit')->name('edit');
                Route::post('/', 'SuggestionTypeController@store')->name('store');
                Route::put('/{id}', 'SuggestionTypeController@update')->name('update');
                Route::delete('/{id}', 'SuggestionTypeController@destroy')->name('delete');
            });

        // Модерация пожеланий и предложений
        Route::prefix('suggestions')
            ->as('suggestions.')->group(function() {
                Route::get('/', 'SuggestionModerationController@index')->name('index');
                Route::patch('/apply/{id}', 'SuggestionModerationController@apply')->name('apply');
                Route::patch('/decline/{id}', 'SuggestionModerationController@decline')->name('decline');
                Route::delete('/{id}', 'SuggestionModerationController@destroy')->name('delete');
            });

        Route::prefix('withdrawal-regulations')
                ->as('withdrawal-regulations.')
                ->group(function() {
                    Route::get('/', 'WithdrawalRegulationsController@index')->name('index');

                    Route::prefix('/commissions')->as('commissions.')->group(function() {
                        Route::get('/edit', 'WithdrawalRegulationsController@editCommissions')->name('edit');
                        Route::put('/update', 'WithdrawalRegulationsController@updateCommissions')->name('update');
                    });

                    Route::prefix('/limits')->as('limits.')->group(function() {
                        Route::get('/edit', 'WithdrawalRegulationsController@editLimits')->name('edit');
                        Route::put('/update', 'WithdrawalRegulationsController@updateLimits')->name('update');
                    });

                });

        Route::prefix('mail')
              ->as('mail.')->group(function() {
                    Route::get('/', 'AdminMailControoler@index')->name('index');
                    Route::post('/send', 'AdminMailControoler@send')->name('send');
              });

        Route::prefix('invite-commission')
            ->as('invite-commission.')
            ->group(function() {
                Route::get('/', 'InviteCommissionController@index')->name('index');
                Route::get('/edit', 'InviteCommissionController@edit')->name('edit');
                Route::put('/edit', 'InviteCommissionController@update')->name('update');
            });

        // Верификация аккаунта (06.04.2021)
        Route::prefix('verif')
                ->as('verif.')
                ->group(function() {
                    Route::get('/', 'VerifAnketAnswerController@show')->name('show');
                    Route::patch('/verife', 'VerifAnketAnswerController@verife')->name('verife');
                    Route::patch('/refuse', 'VerifAnketAnswerController@refuse')->name('refuse');
                    Route::patch('/updateUserVerifeType', 'VerifAnketAnswerController@updateUserVerifeType')->name('updateUserVerifeType');
                    Route::post('/addAttached', 'VerifAnketAnswerController@addAttached')->name('addAttached');
                });

        Route::prefix('global-actions')
                ->as('global-actions.')
                ->group(function() {
                    Route::get('/', 'AdminGlobalActionsController@show')->name('show');
                    Route::post('/down', 'AdminGlobalActionsController@down')->name('down');
                    Route::post('/up', 'AdminGlobalActionsController@up')->name('up');
                });
    });

// Блог
Route::namespace('\Modules\Blog\Http\Controllers')
    ->as('blog.')
    ->prefix('blog')
    ->group(function () {
        Route::redirect('', 'blog/post');
        Route::resource('post', 'PostController', ['only' => ['index', 'show']]);
    });

// Маршруты мониторинга
Route::prefix('tt-mon/' . config('finance.fin_mon_link'))
    ->as('monitoring.')
    ->namespace('Admin')
    ->group(function () {
        Route::get('/', 'MonitoringController@showMainPage')->name('main');
    });

\DB::listen(function ($query) {
    //Log::debug($query->sql);
});


Route::get('/cities/{country}', 'API\CitiesController@index');





