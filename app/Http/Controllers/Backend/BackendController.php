<?php

namespace App\Http\Controllers\Backend;

use App\Models\Consts\PackageConst;
use App\Models\CustomTransaction;
use App\Models\InviteCommission;
use App\Models\Map;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Modules\Blog\Models\Post;
use App\Http\Requests\Backend\Balance\StoreExchange;
use App\Models\Home\Exchange;
use App\Models\UserProperty;
use App\Models\UserStatisticFull;
use Exception;
use App\Helpers\VideoCoursesHelper;
use App\Http\Controllers\Admin\InstantWithdrawalInfoController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Withdraw\RequestWithdraw;
use App\Http\Requests\Frontend\Withdraw\WithdrawRequest;
use App\Mail\ArbitrationAccessRequest;
use App\Mail\BackendFeedback;
use App\Mail\PaymentByPaymentSystemWasMade;
use App\Mail\RequestForAdvertisingMaterial;
use App\Mail\RequestForWithdrawalFromOtherPaymentSystem;
use App\Mail\RequestForWithdrawalWasMade;
use App\Models\BuyPartnersMapApp;
use App\Models\BuyPartnersMapSetting;
use App\Models\Consts\AlertType;
use App\Models\Consts\QuestionConstants;
use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Consts\WalletsTypesConsts;
use App\Models\Home\Alert;
use App\Models\Home\BauntyLink;
use App\Models\Home\Booking;
use App\Models\Home\BookingDetail;
use App\Models\Home\CompanyMaterials\CompanyMaterial;
use App\Models\Home\Currency;
use App\Models\Home\MotivationPlan;
use App\Models\Home\Question;
use App\Models\Home\ReferralAccrualParam;
use App\Models\Home\ServicesCategory;
use App\Models\Home\Transaction;
use App\Models\Home\UserPaymentDetail;
use App\Models\Home\VerifyWithdrawal;
use App\Models\Home\Wallet;
use App\Models\User;
use App\Models\UserStatisticPeriod;
use App\Models\Home\MarketingPlan;
use App\Notifications\ConfirmWithdrawal;
use Dok5\Coinpayments\CoinpaymentsAPI;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Services\WhitebitService;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Models\Partner;
use App\Models\WithdrawalLimit;
use App\Models\WithdrawCommissionSettings;
use App\Notifications\Withdrawal;
use App\Repositories\Referral\ReferralStatisticChart;
use Illuminate\Support\Facades\Validator;
use Session;
use Telegram\Bot\Objects\Venue;
use App\Models\FakeUser;

class BackendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'preventBackHistory']);
    }

    /**
     * Отображение страницы Главная
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showMainPage(Request $request)
    {
        $instanceUser = Auth::user();

        if (is_null($request->datepicker_from) || is_null($request->datepicker_to)) {
            $datapickerFrom = Carbon::parse($instanceUser->created_at)->format('Y-m-d');
            $datapickerTo = date('Y-m-d');
        } else {
            $datapickerFrom = $request->datepicker_from;
            $datapickerTo = $request->datepicker_to;
        }

        $userProperty = new UserProperty( $instanceUser );
        $userStatisticPeriod = new UserStatisticPeriod( $instanceUser, $datapickerFrom, $datapickerTo );
        $userStatisticFull = new UserStatisticFull( $instanceUser );

        // Статистика пользователя
        $dateRegistration = $userProperty->getDateRegistration();
        $yourEmail = $userProperty->getYourEmail();
        $mentor = $userProperty->getMentor();
        $country = $userProperty->getCountry();
        $allReplenishment = number_format( $userStatisticFull->getAllReplenishment(), 2 );
        $totalInvestment = number_format( $userStatisticFull->getTotalInvestment(), 2 );
        $allWithdrawal = number_format( $userStatisticFull->getAllWithdrawal(), 2 );
        $quantityReferrals = $userStatisticFull->getReferralsCount();
        $profitInvestment = number_format( $userStatisticFull->investmentProfitUsd(), 2 );
        $profitAffiliateProgram = number_format( $userStatisticFull->getProfitAffiliateProgram(), 2 );
        $turnoverOneLine = number_format( $userStatisticFull->getTurnoverOneLine(), 2 );
        $teamTurnover = number_format( $userStatisticFull->teamTurnover(), 2);
//        $teamTurnoverPerMonth = number_format( Auth::user()->teamTurnoverPerMonth(), 2);

        switch ($instanceUser->email) {
            case "maksboykoinvest@rambler.ru":
                $quantityReferrals = 482;
                $turnoverOneLine = 213141;
                $teamTurnover = 131648;
                $profitAffiliateProgram = 19574.49;
                $profitInvestment = 5435.24;
                $allWithdrawal = 1600;
                break;
            case "PankratovNIKk1@gmail.com":
                $quantityReferrals = 69;
                $turnoverOneLine = 16896;
                $teamTurnover = 8790;
                $profitAffiliateProgram = 3752;
                $profitInvestment = 2046;
                $allWithdrawal = 1000;
                break;
            case "vlad_1209@rambler.ru":
                $quantityReferrals = 20;
                $profitAffiliateProgram = 470;
                $turnoverOneLine = 4200;
                $teamTurnover = 1800;
                $profitInvestment = 5;
                break;
            case "niihorin12@gmail.com":
                $quantityReferrals = 824;
                $turnoverOneLine = 347500;
                $teamTurnover = 580800;
                $profitAffiliateProgram = 41700;
                $profitInvestment = 15420.54;
                $allWithdrawal = 1000;
                $allReplenishment = 150000.00;
                $totalInvestment = 200000.00;
                break;
            case "mishaorlov0784@gmail.com":
                $quantityReferrals = 50;
                $profitAffiliateProgram = 1348;
                $turnoverOneLine = 8036;
                $teamTurnover = 13700;
                $profitInvestment = 235;
                break;
            case "romankoval31@rambler.ru":
                $quantityReferrals = 53;
                $turnoverOneLine = 16423;
                $teamTurnover = 7498;
                $profitAffiliateProgram = 1046.65;
                $profitInvestment = 621.93;
                $allWithdrawal = 100;
                break;
            case "hyuduakh@firstmailler.com":
                $quantityReferrals = 16;
                $profitAffiliateProgram = 488;
                $turnoverOneLine = 2500;
                $teamTurnover = 5500;
                break;
            case "lubiqijl@raymanmail.com":
                $quantityReferrals = 25;
                $profitAffiliateProgram = 425;
                $turnoverOneLine = 4500;
                $teamTurnover = 1570;
                break;
            //case "vcf.industrial@gmail.com":
            case "alina.vvladimirovnaa@gmail.com":
                $quantityReferrals = 42;
                $turnoverOneLine = 12224;
                $teamTurnover = 5072;
                $profitAffiliateProgram = 3345.76;
                $profitInvestment = 652.38;
                $allWithdrawal = 200;
                break;
            case "kriptondmitrij753@gmail.com":
                $quantityReferrals = 46;
                $turnoverOneLine = 59686;
                $teamTurnover = 19575;
                $profitAffiliateProgram = 10104.65;
                $profitInvestment = 1819.8;
                $allWithdrawal = 200;
                $allReplenishment = 20000;
                break;
        }

        // Заработано по карьерной программе:
        $careerProgram = $userStatisticPeriod->getCareerProgram();
        // Заработано по линейной программе:
        //закриваю по тз
        //  $linearProgram = $userStatisticPeriod->getLinearProgram();
        $linearProgram = 0;  // щоб не ламати системи)

        //Матчинг бонус:
        $matchingBonus = $userStatisticPeriod->getMatchingBonus();


        // Лидерский бонус:
//        $leadershipBonus = $userStatisticPeriod->getLeadershipBonus();
        // Всего по партнерской программе = Карьерная + Линейная + Матчинг бонус + Лидерский бонус
        $totalAffiliateProgram = $careerProgram + $linearProgram + $matchingBonus; // + $leadershipBonus;
        // Прибыль от инвестиций:
        $profitOfInvestments = $userStatisticPeriod->getProfitOfInvestments();

        // Всего заработано = Всего по партнерской программе + Прибыль от инвестиций
        $totalEarned = $totalAffiliateProgram + $profitOfInvestments;
        // Выведено средств:
        $fundsWithdrawn = $userStatisticPeriod->getFundsWithdrawn();
        // Инвестиций:
        $investment =  $userStatisticPeriod->getInvestment();

        // Пополнений:
        $replenishment = $userStatisticPeriod->getReplenishmentInvest();

        $sumClosedPackages = Auth::user()->getSumClosedPackages([Auth::user()->id]);

        $posts = Post::published()
            ->with([
                'author:id,name',
                'category:id,name,color',
            ])
            ->latest('published_at')
            ->select([
                'id',
                'category_id',
                'author_id',
                'name',
                'slug',
                'excerpt',
                'image',
                'published_at',
            ])
            ->limit(4)
            ->get();

        $packages = MarketingPlan::whereActivePlansInSystem()->get();
        $inviteCommission = InviteCommission::getCommissions();


        // Отправлено средств внутренним переводом:
        $userTransferSendMoney =  DB::table('transactions')
            ->where([
                'transaction_type_id' => TransactionsTypesConsts::USER_TRANSFER_SEND,
                'user_id' => $instanceUser->id
            ])
            ->whereBetween('created_at', [$datapickerFrom, $datapickerTo])
            ->sum('amount_usd');

        // Получено средств внутренним переводом:
        $userTransferTakeMoney =  DB::table('transactions')
            ->where([
                'transaction_type_id' => TransactionsTypesConsts::USER_TRANSFER_GET,
                'user_id' => $instanceUser->id
            ])
            ->whereBetween('created_at', [$datapickerFrom, $datapickerTo])
            ->sum('amount_usd');

        // Баланс:
        // Доступно к выводу:

        // Список фейков-мультиаккаунтов
        $userFakes = DB::table('users')
            ->select('email')
            ->join('attached_users','users.id','=','attached_users.attach_id')
            ->where('attached_users.user_id','=',$instanceUser->id)
            ->get();

            // SELECT email FROM `fakes_users` join `users` on(`users`.id = `fakes_users`.fake_id) WHERE `fakes_users`.user_id = 1092

            // SELECT email FROM `users` join `fakes_users` on(`users`.id = `fakes_users`.fake_id) WHERE `fakes_users`.user_id = 1092


        return view('dashboard.lk', compact(
            'posts',

            'datapickerFrom',
            'datapickerTo',

            'dateRegistration',
            'yourEmail',
            'mentor',
            'country',
            'allReplenishment',
            'totalInvestment',
            'allWithdrawal',
            'quantityReferrals',
            'profitInvestment',
            'profitAffiliateProgram',
            'turnoverOneLine',
            'teamTurnover',
//            'teamTurnoverPerMonth',

            'careerProgram',
            'linearProgram',
            'matchingBonus',
//            'leadershipBonus',
            'totalAffiliateProgram',
            'profitOfInvestments',
            'totalEarned',
            'fundsWithdrawn',
            'investment',
            'replenishment',
            'sumClosedPackages',
            'packages',
            'inviteCommission',
            'userTransferSendMoney',
            'userFakes'
        ));
    }


    /**
     * @param User $user
     * @param string $from
     * @param string $to
     * @param null|int $depth
     * @return array
     */
    private function generateStatsByPeriod(User $user, string $from, string $to, $depth = null)
    {
        $depthData = $user->getDepthData($depth);

        $transactionQuery = Transaction::query()
            ->whereIn('user_id', array_keys($depthData['filtered']))
            ->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59'])
            ->whereRaw('amount_usd < 0')
            ->where('transaction_type_id', TransactionsTypesConsts::INVEST_TO_MARKETING_PLAN_FROM_MAIN_BALANCE);

        return [
            'plans_count' => $transactionQuery->count(),
            'plans_sum_usd' => abs($transactionQuery->sum('amount_usd')),
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function changeTelegramId(Request $request)
    {
        Auth::user()->update(['telegram_id' => (int)$request->post('id')]);
        return ['status' => true, $request->post('id')];
    }

    /**
     * Отображает страницу Рефералы.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showReferralsPage(Request $request)
    {
        $refferralsRecursive = Auth::user()
            ->refferrals()
            ->orderBy('email_verified_at', 'desc')
            ->paginate(10);

        $user = Auth::user();
        $stats = [];
        $maxDepth = $user->getDepthData()['maxDepth'];
        if (request('stats')) {
            $stats = $this->generateStatsByPeriod(
                $user,
                request('filter.from'),
                request('filter.to'),
                request('filter.depth')
            );
        }
        $usersForInvitationDeposit = User::where('parent_id', $user->id)
            ->whereDoesntHave('userAllMarketingPlans')
            ->select([
                'name',
                'email',
            ])
            ->get()
            ->toArray();


        /* todo: разобраться зачем это
        $user         = User::withDepth()->find(Auth::user()->id);
        $teamTurnover = $this->countAllRefferrals($user);
        $referrals = [];
        for ($i = 1; $i <= config('referrals.number_referral_levels'); $i++) {
            $referrals_on_level = $user->getDescendants($i);
            // Если на уровне нет реферальных пользователей - прерываем
            if ($referrals_on_level->isEmpty()) {
                break;
            }

            // Определяем доход, полученный от линии
            $profit_from_line = $user->profitFromUsers($referrals_on_level);
            $referrals[] = [$referrals_on_level, $profit_from_line];
        }
        */

        $userProperty = new UserProperty($user);
        $userStatisticFull = new UserStatisticFull($user);

        // Статистика пользователя
        $dateRegistration = $userProperty->getDateRegistration();
        $yourEmail = $userProperty->getYourEmail();
        $mentor = $userProperty->getMentor();
        $country = $userProperty->getCountry();
        $allReplenishment = number_format( $userStatisticFull->getAllReplenishment(), 2 );
        $quantityReferrals = $userStatisticFull->getReferralsCount();
        $profitAffiliateProgram = number_format( $userStatisticFull->getProfitAffiliateProgram(), 2 );
        $turnoverOneLine = number_format( $userStatisticFull->getTurnoverOneLine(), 2 );
        $teamTurnover = number_format( $userStatisticFull->teamTurnover(), 2);

        $packages = MarketingPlan::whereActivePlansInSystem()->get();
        $inviteCommission = InviteCommission::getCommissions();

        $partnersMapInfo = BuyPartnersMapSetting::find(1);
        $partnersMapShow = BuyPartnersMapApp::where('user_id', $user->id)->first();

        switch ($user->email) {
            case "niihorin12@gmail.com":
                $quantityReferrals = 824;
                $turnoverOneLine = 347500;
                $teamTurnover = 580800;
                $profitAffiliateProgram = 41700;
                break;
            case "maksboykoinvest@rambler.ru":
                $quantityReferrals = 482;
                $turnoverOneLine = 213141;
                $teamTurnover = 131648;
                $profitAffiliateProgram = 19574.49;
                Auth()->user()->bonus_level = 16;
                break;
            case "PankratovNIKk1@gmail.com":
                $quantityReferrals = 69;
                $turnoverOneLine = 16896;
                $teamTurnover = 8790;
                $profitAffiliateProgram = 3752;
                break;
            //case "vcf.industrial@gmail.com":
            case "alina.vvladimirovnaa@gmail.com":
                $quantityReferrals = 42;
                $turnoverOneLine = 12224;
                $teamTurnover = 5072;
                $profitAffiliateProgram = 3345.76;
                Auth()->user()->bonus_level = 11;
                break;
            case "kriptondmitrij753@gmail.com":
                $quantityReferrals = 46;
                $turnoverOneLine = 59686;
                $teamTurnover = 19575;
                $profitAffiliateProgram = 10104.65;
                Auth()->user()->bonus_level = 15;
                break;
            case "romankoval31@rambler.ru":
                $quantityReferrals = 53;
                $turnoverOneLine = 16423;
                $teamTurnover = 7498;
                $profitAffiliateProgram = 1046.65;
                break;
        }

        return view('dashboard.partners.main', compact(
            'dateRegistration',
            'yourEmail',
            'mentor',
            'country',
            'allReplenishment',
            'quantityReferrals',
            'profitAffiliateProgram',
            'turnoverOneLine',
            'teamTurnover',
            'user',
            'refferralsRecursive',
            'stats',
            'maxDepth',
            'usersForInvitationDeposit',
            'partnersMapInfo',
            'partnersMapShow',
            'packages',
            'inviteCommission'
        ));
    }

    protected function countAllRefferrals( $refferrals )
    {
        $refferrals->TeamTurnover = 0;
        if ($refferrals->id != Auth()->user()->id) {
            $refferrals->TeamTurnover += $refferrals->invested_usd;
        }
        foreach( $refferrals->refferralsRecursive as $child ) {
            $refferrals->TeamTurnover += $this->countAllRefferrals( $child );
        }
        return $refferrals->TeamTurnover;
    }

    /**
     * Отображает страницу О реф. программе.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAboutReferralsPage()
    {
        $referral_params = ReferralAccrualParam::where('percent', '>', 0)
            ->orderBy('id')
            ->get();

        return view('backend.pages.about-referrals')->with([
            'referral_params' => $referral_params,
        ]);
    }

    public function fetchExam(int $moduleId)
    {
        return Question::on()->where('module_id', $moduleId)->get();
    }

    public function showProfiUniversePage()
    {
        $paid = VideoCoursesHelper::getIsPaid();
        $servicesCategoryId = ServicesCategory::PROFI_UNIVERSE_ID;
        $listModules = [];

        for($i = 1; $i <= 5; $i++) {
            $listModules[] = Question::on()->where('module_id', $i)->get();
        }
        $showVideo = VideoCoursesHelper::getArrayShowVideo();
        $showButton = VideoCoursesHelper::getArrayShowButton();
        return view('backend.pages.profi-universe', compact(
            'paid',
            'servicesCategoryId',
            'listModules',
            'showVideo',
            'showButton'
        ));
    }

    public function writeAnswer(Request $request)
    {
        $frontAnswer = $request->all();
        unset( $frontAnswer['_token'] );
        unset( $frontAnswer['module_id'] );
        $dataAnswer = [];

        for ( $i = 1; $i <= intval(count($frontAnswer) / 2); $i++ ) {
            $dataAnswer[] = [
                'user_id' => Auth::user()->id,
                'question_id' => $frontAnswer['question_' . $i],
                'answer' => $frontAnswer['answer_' . $i],
            ];
        }

        DB::table('answer')->insert($dataAnswer);

        return back();
    }

    /**
     * Страница баланса.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showInvestPage(Request $request)
    {
        $payments = UserPaymentDetail::where('user_id', Auth::user()->id)
            ->OrderByDesc('id')
            ->limit(10)
            ->get();

        $customTransaction = CustomTransaction::query()->first();
        $userToUserMin = $customTransaction->getAttribute('min');
        $userToUserCommission = $customTransaction->getAttribute('commission');
        $userToUserMax = $customTransaction->getAttribute('max');
        $currentBalance = Auth::user()->balance_usd;
        $withdrawalModal = \App\Models\InstantWithdrawalInfo::select('title', 'content')->find(1);

        // Расчет комиссии на вывод
        $lastWithdrawalDate = Transaction::select('created_at')
                                ->where('user_id', Auth::user()->id)
                                ->whereIn('transaction_type_id', [TransactionsTypesConsts::WITHDRAWAL_REQUEST_TYPE_ID, TransactionsTypesConsts::WITHDRAWAL_TYPE_ID])
                                ->latest()
                                ->first();

        if($lastWithdrawalDate) {
            $lastWithdrawalDate =  $lastWithdrawalDate->created_at;
        }

        $commission = 3;

        $now = Carbon::now();
        $delta = 31;

        if($lastWithdrawalDate) {
            $delta = $lastWithdrawalDate->diff($now)->days;
        }
        if($delta < 7)
        {
            $period = 7;
        }
        else if($delta < 14)
        {
            $period = 14;
        }
        else if($delta < 30) {
            $period = 30;
        }
        else {
            $period = 0;
        }

        $commission = WithdrawCommissionSettings::where('period', $period)->first()->commission;

        $withdrawalLimits = WithdrawalLimit::pluck('value','name');

        // Расчет комиссии на вывод
        $lastWithdrawalDate = Transaction::select('created_at')
                                ->where('user_id', Auth::user()->id)
                                ->whereIn('transaction_type_id', [TransactionsTypesConsts::WITHDRAWAL_REQUEST_TYPE_ID, TransactionsTypesConsts::WITHDRAWAL_TYPE_ID])
                                ->latest()
                                ->first();

        if($lastWithdrawalDate) {
            $lastWithdrawalDate =  $lastWithdrawalDate->created_at;
        }

        $commission = 3;

        $now = Carbon::now();
        $delta = 31;

        if($lastWithdrawalDate) {
            $delta = $lastWithdrawalDate->diff($now)->days;
        }
        if($delta < 7)
        {
            $period = 7;
        }
        else if($delta < 14)
        {
            $period = 14;
        }
        else if($delta < 30) {
            $period = 30;
        }
        else {
            $period = 0;
        }

        $commission = WithdrawCommissionSettings::where('period', $period)->first()->commission;


        // дата последней транзации по типу перевода с Dinway Wallet на основной баланс
        $dateLastDinwayWalletTransaction = Transaction::select('created_at')->where([
            'transaction_type_id' => TransactionsTypesConsts::DINWAY_WALLET_DEBT_USD_WITHDRAWAL,
        ])
        ->orderBy('created_at', 'desc')->first()->created_at ?? null;

        return view('dashboard.balance.main', compact(
            'payments',
            'userToUserCommission',
            'userToUserMin',
            'userToUserMax',
            'currentBalance',
            'withdrawalModal',
            'commission',
            'withdrawalLimits',
            'dateLastDinwayWalletTransaction'
        ));
    }

    public function PostInvestPage(Request $request)
    {
        $currentUser = User::find(Auth::user()->id);
        $currentBalance = $currentUser->balance_usd;
        extract(CustomTransaction::select('min', 'max', 'commission')->first()->getAttributes()); // $min $max $commission
        $max = $max > $currentBalance ? $currentBalance : $max; // учет максимально возможного значения с суммой на балансе

        $rules = [
            'user_email' => [
                'required',
                'email',
                Rule::notIn([Auth::user()->email]),
                Rule::exists('users', 'email'),
            ],
            'transfer_amount' => "required|numeric|min:$min|max:$max",
        ];

        $messages = [
            'user_email.required' => __('base.dash.balance.custom_translations.errors.email-required'),
            'user_email.email' => __('base.dash.balance.custom_translations.errors.email'),
            'user_email.not_in' => __('base.dash.balance.custom_translations.errors.currentUser'),
            'user_email.exists' => __('base.dash.balance.custom_translations.errors.email-exists', ['email' => $request->input('user_email')]),
            'transfer_amount.required' => __('base.dash.balance.custom_translations.errors.transfer_amount-required'),
            'transfer_amount.numeric' => __('base.dash.balance.custom_translations.errors.format'),
            'transfer_amount.min' => __('base.dash.balance.custom_translations.errors.min'),
            'transfer_amount.max' => $max == $currentBalance ?
                                      __('base.dash.balance.custom_translations.errors.balance')
                                    : __('base.dash.balance.custom_translations.errors.max'),
        ];

        $validatedData = Validator::make($request->all(), $rules, $messages)->validate();

        $recipientEmail = $validatedData['user_email'];
        $recipient = User::where('email', $recipientEmail)->first();

        $originalSum =  $validatedData['transfer_amount'];  // Сумма денег, которую хочет перевести клиент
        $finalSum = $originalSum * (1 - $commission / 100); // Итоговая сумма, которая придет другому пользователю с учетом комиссии

        $recipientBalanceUsd = $recipient->balance_usd;

        DB::beginTransaction();   // Снять деньги у текущего пользователя, отправить другому
        try {

            $currentUser->update([
                'balance_usd' => $currentBalance -  $originalSum, // Снять деньги со счёта
                'updated_at' => Carbon::now()
            ]);

            $recipient->update([
                'balance_usd' => $recipientBalanceUsd + $finalSum, // Перевод пользователю
                'updated_at' => Carbon::now()
            ]);

            UserPaymentDetail::insert(
                [
                    [ // сообщение отправителю
                        'user_id' => $currentUser->id,
                        'currency_id' => 27,
                        'address' => 'Пользовательские переводы',
                        'additional_data' => "User money transfer send#$originalSum#USD#commission:$commission#email:$recipientEmail",
                        'created_at' => Carbon::now(),
                    ],
                    [ // сообщение получателю
                        'user_id' => $recipient->id,
                        'currency_id' => 27,
                        'address' => 'Пользовательские переводы',
                        'additional_data' => "User money transfer give#$finalSum#USD#email:$currentUser->email",
                        'created_at' => Carbon::now()
                    ],
                ]
            );


            Alert::insert(
                [
                    [ // оповещения в настройках, отправителю
                        'user_id' => $currentUser->id,
                        'email' => $recipientEmail,
                        'amount' => $originalSum,
                        'alert_id' => 32,
                        'add_info' => json_encode([
                            'ru' => "Комиссия: $commission%",
                            'en' => "Commission: $commission%"
                        ]),
                        'currency_type' => 'usd',
                        'marketing_plan_id' => null,
                        'created_at' => Carbon::now(),
                    ],
                    [ // оповещения в настройках, получателю
                        'user_id' => $recipient->id,
                        'email' => $currentUser->email,
                        'amount' => $finalSum,
                        'alert_id' => 33,
                        'add_info' => null,
                        'currency_type' => 'usd',
                        'marketing_plan_id' => null,
                        'created_at' => Carbon::now(),
                    ]
                ]
            );

            Transaction::insert([
                [ // отправитель
                    'user_id' => $currentUser->id,
                    'transaction_type_id' => TransactionsTypesConsts::USER_TRANSFER_SEND,
                    'amount_usd' => $originalSum,
                    'balance_usd_after_transaction' => $currentBalance - $originalSum,
                    'commission' => $commission,
                    'related_user_id' => $recipient->id,
                    'created_at' => Carbon::now(),
                ],
                [ // получатель
                    'user_id' => $recipient->id,
                    'transaction_type_id' => TransactionsTypesConsts::USER_TRANSFER_GET,
                    'amount_usd' => $finalSum,
                    'balance_usd_after_transaction' => $recipientBalanceUsd + $finalSum,
                    'related_user_id' => $currentUser->id,
                    'commission' => null,
                    'created_at' => Carbon::now(),
                ],
            ]);

            DB::commit();
        }catch(\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }

        Session::flash('transferSuccess', __('base.dash.balance.custom_translations.success', [
            'email' => $recipientEmail,
            'sum' => $finalSum
        ]));

        return  redirect()->route('home.balance');
    }

    public function createPayment(Request $request)
    {
        if ( $request->pay == 'payeer' || $request->pay == 'pm' ) {
            $this->validate($request, [
              'pay' => 'required',
              'summ' => 'required|integer|min:1|max:10000',
            ]);
        } else {
            $this->validate($request, [
              'pay' => 'required',
                'summ' => 'required|numeric',
//              'summ' => 'required|between:0,99.99|max:10000',
            ]);
        }

        //if ( ! in_array($request->pay, ['payeer','pm', 'btc', 'eth', 'usdt', 'pzm']) ) {
        if ( ! in_array($request->pay, ['usdt']) ) {
            return redirect()->back()->with('unsupportedPayment', 'неподдерживаемая платежная система');
        }

        try {
            DB::beginTransaction();
            switch($request->pay){
                case 'payeer': $currency = Currency::where('name','Payeer USD')->first(); break;
                case 'pm':     $currency = Currency::where('name','Perfect Money')->first(); break;
                case 'btc':    $currency = Currency::where('name','Bitcoin')->first(); break;
                case 'pzm':    $currency = Currency::where('name','Prizm')->first(); break;
                case 'eth':    $currency = Currency::where('name','Ethereum')->first(); break;
                case 'usdt':   $currency = Currency::where('name','Tether')->first(); break;
            }
            $paymentNum = new UserPaymentDetail();
            $paymentNum->currency_id = $currency['id'];
            $paymentNum->user_id = Auth::user()->id;
            $paymentNum->address = '';
            $paymentNum->additional_data = "Balance replenishment#" . $request->summ . '#' . $currency->code;
            $paymentNum->save();
            DB::commit();

            if ( $request->pay=='payeer' ) {
                return redirect()->route('home.balance.payment.payeer', ['id' => $paymentNum->id]);
            }

            if ( $request->pay=='pm' ) {
                return redirect()->route('home.balance.payment.pm', ['id' => $paymentNum->id]);
            }

            if ( $request->pay=='btc' || $request->pay=='eth' || $request->pay=='pzm' || $request->pay=='usdt' ) {
                return redirect()->route('home.balance.payment.coin', ['id' => $paymentNum->id]);
            }
        } catch(\Exception $e) {
            DB::rollback();
            return back()->with(['flash_danger' => 'Ошибка '. $e->getMessage()]);
        }
    }

    public function buttonContinue(Request $request)
    {
        $currencyId = UserPaymentDetail::find( $request->id )->currency_id;
        switch ( $currencyId ) {
            case 22:
                return redirect()->route('home.balance.payment.pm', ['id' => $request->id]);
                break;
            case 1:
            case 2:
            case 25:
            case 29:
                return redirect()->route('home.balance.payment.coin', ['id' => $request->id]);
                break;
        }
        return back();
    }

    public function requestWithdrawal(RequestWithdraw $request)
    {
        // $limits = WithdrawalLimit::find() ?? 10000000;
        $this->validate($request, [
            'currency_id'   => 'required',
            'amount'        => 'required',
            'address'       => 'required',
            'amount1'       => 'required',
        ]);

        if($request->input('card_name') !== null) {
            $limit = WithdrawalLimit::where('name', 'card')->first();

            if($request->input('amount') > $limit->value) {
                return redirect()->back()->withErrors([
                    __('website_home.package.error-max-card', ['limit' => $limit->value])
                ]);
            }
        }

        try {
            $currency = Currency::findOrFail($request->currency_id);
            $code = 'balance_' . ($request->currency_id == 29 ? 'usd' : strtolower($currency->code));

            if (Auth()->user()->$code < $request->amount) {
                return redirect()->back()->withErrors([
                    __('website_home.package.error_not_enough_money', ['currency' => strtoupper($currency->code)])
                ]);
            }

            $isCrypto = false;
            switch ($request->currency_id) {
                // id == $request->currency_id    Code    Name
                case 18: //                 USD   Payeer USD
                    $minPayout = 5;
                    break;
                case 1: //                  BTC     Bitcoin
                    $isCrypto = true;
                    $minPayout = 25 * 1 / Auth()->user()->getCurrencyeUsd('bitcoin');
                    $minPayout = number_format($minPayout, 8);
                    break;
                case 25: //                 PZM     Prizm
                    $isCrypto = true;
                    $minPayout = 25 * 1 / Auth()->user()->getCurrencyeUsd('prizm');
                    $minPayout = number_format($minPayout, 8);
                    break;
                case 22: //                 USD     Perfect Money
                    $minPayout = 5;
                    break;
                case 2: //                  ETH     Ethereum
                    $isCrypto = true;
                    $minPayout = 25 * 1 / Auth()->user()->getCurrencyeUsd('ethereum');
                    $minPayout = number_format($minPayout, 8);
                    break;
                case 29: //                 USDT    Tether
                    $isCrypto = true;
                    $minPayout = 25;
                    $minPayout = number_format($minPayout, 8);
                    break;
                case 16: //                 USD     Visa
                    $minPayout = 40;
                    break;
                default:
                    $minPayout = 30;
                    break;
            }

            if ($isCrypto && $request->currency_id != 29) {
                if (!Auth::user()->is_allow_withdraw_crypto) {
                    return redirect()->back()->withErrors(__('base.dash.balance.stop_withdraw'));
                }
            }

            if ( $request->amount < $minPayout ) {
                return redirect()->back()->withErrors(__('base.dash.balance.minimal', [
                    'amount'    => $minPayout,
                    'currency'  => $currency->code,
                ]));
            }

            if ($request->card_name) {
                $metaDetails = [
                    'card_details' => [
                        'surname' => $request->card_surname,
                        'name' => $request->card_name,
                        'patronymic' => $request->card_patronymic,
                        'number' => $request->card_number,
                        'phone' => $request->card_phone
                    ]
                ];
            } elseif ($request->crypto_memo) {
                $metaDetails = [
                    'crypto_details' => [
                        'memo' => $request->crypto_memo,
                    ]
                ];
            } else {
                $metaDetails = null;
            }

            $token = Str::random(60);
            $notify = new VerifyWithdrawal;
            $notify->user_id = Auth()->user()->id;
            $notify->currency_id = $request->currency_id;
            $notify->amount = $request->amount;
            $notify->address = $request->address;
            $notify->name = json_encode($metaDetails, JSON_UNESCAPED_UNICODE);
            $notify->token = $token;
            $notify->save();
            $data = [
                'token' => $token,
                'email' => Auth()->user()->email,
            ];
            session()->put('withdraw_token', $token);
            Auth()->user()->notify((new ConfirmWithdrawal($data))->locale(\App::getLocale()));
            return redirect()->route('website.withdraw.confirm');
        } catch (Exception $e) {
            // Если по id ничего не нашли в таблице currencies
            if ($e instanceof ModelNotFoundException) {
                return redirect()->back();
            } else {
                return redirect()->back()->withErrors($e->getMessage());
            }
        }
    }

    public function showWithdrawConfirmForm()
    {
        return view('withdraw.withdrawVerification');
    }

    public function verifyWithdrawalByCode(WithdrawRequest $request)
    {
        $token= session()->get('withdraw_token');
        $code=session()->get('withdraw_verification');
        $_withdrawal= \App\Models\WithdrawVerification::where('code', $code)->where('user_id',\Auth::user()->id)->where('status','pending')->first();
        $withdrawal = VerifyWithdrawal::where('token', $token)->first();

        if ($code != $request->input('code')) {
            session()->flash('alert-error', 'Вы указали некорректный код.');
            return redirect()->route('website.withdraw.confirm');
        }

        //$code = 'balance_' . strtolower($withdrawal->currency->code);
        //$code = 'balance' . ($request->currency_id == 29 ? 'usd' : strtolower($currency->code)); // Доделать правильно!!
        $code = 'balance_usd';

        if (Auth()->user()->$code < $withdrawal->amount) {
            session()->flash('alert-error', 'У вас недостаточно средств на счету.');
            return redirect()->route('website.withdraw.confirm');
        }

        if (!$withdrawal) {
            session()->flash('alert-error', 'Заявка на вывод не найдена.');
            return redirect()->route('website.withdraw.confirm');
        }

        if ($this->createPayout($withdrawal)) {
            \Log::info('Verify',array($withdrawal));
            \App\Models\WithdrawVerification::where('code', $code)->where('user_id',\Auth::user()->id)->where('id',$_withdrawal->id)->update(['status'=>'completed']);
            return redirect()->route('home.balance')->with(['flash_success' => 'Заявка успешно подтверждена.']);
        }else {
            return abort(404);
        }

    }

    public function verifyWithdrawal($token)
    {
        $withdrawal = VerifyWithdrawal::where('token', $token)->first();

        if (!$withdrawal) {
            return abort(404);
        }
        if ($this->createPayout($withdrawal)) {
            return redirect()->route('home.balance')->with(['flash_success' => 'Success.']);
        }else {
            return abort(404);
        }

    }

    public function createPayout($withdrawal)
    {
        $code                          = strtolower($withdrawal->currency->code) != 'usdt' ? strtolower($withdrawal->currency->code) : 'usd';
        $codeName                      = strtolower($withdrawal->currency->name);
        $codeBalans                    = 'balance_'.$code;
        $codeAmount                    = 'amount_'.$code;
        $code_balans_after_transaction = 'balance_'.$code.'_after_transaction';
        $user = User::find($withdrawal->user_id);
            if ($user->$codeBalans >= $withdrawal->amount) {
                DB::beginTransaction();
                try{
                    Log::info('Name'.$withdrawal->name);
                    $wallet                 = new Wallet;
                    $wallet->user_id        = $user->id;
                    $wallet->currency_id    = $withdrawal->currency_id;
                    $wallet->address        = $withdrawal->address;
                    $wallet->wallet_type_id = WalletsTypesConsts::WITHDRAWAL_WALLET_TYPE_ID;
                    $wallet->save();

                    // Расчет комиссии на вывод
                    $lastWithdrawalDate = Transaction::select('created_at')
                    ->where('user_id', Auth::user()->id)
                    ->whereIn('transaction_type_id', [TransactionsTypesConsts::WITHDRAWAL_REQUEST_TYPE_ID, TransactionsTypesConsts::WITHDRAWAL_TYPE_ID])
                    ->latest()
                    ->first();

                    if($lastWithdrawalDate) {
                        $lastWithdrawalDate =  $lastWithdrawalDate->created_at;
                    }

                    $commission = 3;

                    $now = Carbon::now();
                    $delta = 31;

                    if($lastWithdrawalDate) {
                        $delta = $lastWithdrawalDate->diff($now)->days;
                    }
                    if($delta < 7)
                    {
                        $period = 7;
                    }
                    else if($delta < 14)
                    {
                        $period = 14;
                    }
                    else if($delta < 30) {
                        $period = 30;
                    }
                    else {
                        $period = 0;
                    }

                    $commission = WithdrawCommissionSettings::where('period', $period)->first()->commission;

                    $amount = $withdrawal->amount * (1 - $commission / 100);
                    // Тут так реализовано что комиссия не в процентах, а в долларах
                    $commission  = $withdrawal->amount - $amount;

                    $balance_after_transaction                   = $user->$codeBalans-$withdrawal->amount;
                    $transaction                                 = new Transaction;
                    $transaction->user_id                        = $user->id;
                    $transaction->transaction_type_id            = TransactionsTypesConsts::WITHDRAWAL_REQUEST_TYPE_ID;
                    $transaction->wallet_id                      = $wallet->id;
                    $transaction->name                           = $withdrawal->name;
                    $transaction->$codeAmount                    = -$withdrawal->amount;
                    $transaction->commission                     = $commission;
                    if ($code != 'usd') {
                        $transaction->amount_crypto =  -($withdrawal->amount*Auth()->user()->getCurrencyeUsd($codeName));
                        $transaction->rate          =  Auth()->user()->getCurrencyeUsd($codeName);
                    }
                    $transaction->currency_id                    = $withdrawal->currency_id;
                    $transaction->$code_balans_after_transaction = $balance_after_transaction;
                    $transaction->save();

                    $alert                = new Alert;
                    $alert->user_id       = $user->id;
                    $alert->alert_id      = AlertType::WITHDRAWAL;
                    $alert->amount        = $amount;
                    $alert->currency_id   = $withdrawal->currency_id;
                    $alert->currency_type   = $code;
                    $alert->save();

                    $payout                  = new UserPaymentDetail();
                    $payout->currency_id     = $withdrawal->currency_id;
                    $payout->user_id         = Auth::user()->id;
                    $payout->address         = '';
                    $payout->transaction_id  = $transaction->id;
                    $payout->additional_data = "Balance pay out#".$amount.'#'.$withdrawal->currency->code.'';
                    $payout->save();

                    //$service = new WhitebitService();
                    //$response = $service->withdraw($withdrawal->amount, $withdrawal->address, null);

                    $mail = trim(config('finance.payment_system_notifications_email'));
                    Mail::to($mail)->send(new RequestForWithdrawalWasMade([
                        'email'   => Auth::user()->email,
                        'wallet'  => $wallet->currency->code,
                        'amount_usd' => $withdrawal->amount,
                        'address' => $withdrawal->address,
                        'additional_data' => '',
                    ]));

                    if ($withdrawal->currency->code == 'USD') {
                        $withdrawalAmount = $withdrawal->currency->code.' '.number_format($withdrawal->amount, 2);
                    }else {
                        $withdrawalAmount = $withdrawal->currency->code.' '.$withdrawal->amount;
                    }
                    /* $text = "<b><i>Заявка на вывод.</i></b>\n"
                                . "Email: "
                                . $user->email."\n"
                                . "Платежную систему: "
                                . "<b>".$withdrawal->currency->name."</b>\n"
                                . "Кошелек: "
                                . "<b>".$withdrawal->address."</b>\n"
                                . "Сумма: "
                                . "<b>".$withdrawalAmount."</b>\n"
                                . "Комиссия: "
                                . "<b>".$withdrawal->currency->code.' '.($withdrawal->amount*0.01)."</b>\n"
                                . "Дата: "
                                . "<b>".$withdrawal->created_at."</b>\n";

                    Telegram::sendMessage([
                        'chat_id' => env('TELEGRAM_CHANNEL_ID', '735032395'),
                        'parse_mode' => 'HTML',
                        'text' => $text
                    ]); */

                    $withdrawal->delete();

                    DB::commit();
                return true;
            }catch(\Exception $e) {
                DB::rollback();
                return false;
            }
        }else {
            return redirect()->route('home.main');
        }
    }

    public function showOffersPage()
    {
        $plans = MotivationPlan::all();
        $plans->load(['params']);

        return view('backend.pages.offers')
            ->withPlans($plans);
    }

    public function showAdvertisingPage()
    {
        return view('backend.pages.advertising');
    }

    public function showTeachingPage()
    {
        return view('backend.pages.teaching');
    }

    public function showFaqPage()
    {
        return view('dashboard.faq');
    }

    public function getNewWalletAddress(Currency $currency, Wallet $wallet)
    {
        $cp = new CoinpaymentsAPI(
            config('coinpayments.private_key'),
            config('coinpayments.public_key'),
            'json'
        );

        $r = $cp->GetOnlyCallbackAddress($currency->code);

        if ($r['error'] == 'ok') {
            Log::channel('actionlog')->info(Auth()->user()->email . '(id=' . Auth()->user()->id . ') сгенерировал кошелек ' . $currency->code . ' ' . serialize($r));
            $r = $r['result'];
            // Если в массиве API-данных есть ключ dest_tag - возвращаем его
            // todo удобно было бы сделать метод, который возвращал был значение ключа массива, если ключ есть или null, если ключа нет
            $tag = array_key_exists('dest_tag', $r) ? $r['dest_tag'] : null;

            $wallet->user_id = Auth()->user()->id;
            $wallet->currency_id = $currency->id;
            $wallet->wallet_type_id = WalletsTypesConsts::INVEST_WALLET_TYPE_ID;
            $wallet->address = $r['address'];
            $wallet->additional_data = $tag;
            $wallet->save();
        } else {
            Log::channel('actionlog')->info(Auth()->user()->email . '(id=' . Auth()->user()->id . ') ошибка при генерировании кошелька ' . $currency->code . ' ' . serialize($r));
        }

        return back();
    }

    /**
     * Обработка выполненной оплаты через платежную систему.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePayed(Request $request)
    {
        $rule = 'mimes:jpeg,jpg,png,gif|required|max:5242880'; // max 5 Mb
        $rules = array(
            'photo1' => $rule,
            'photo2' => $rule,
            'photo3' => $rule,
            'photo4' => $rule,
        );
        // todo Возникает исключение "Error loading images. Make sure that the image has a resolution of no more than 1024 x 1024 pixels.". Временно отключил валидацию. Разобраться потом.
        /*$validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->with([
                'flash_danger' => __('validation.custom.image.common_error'),
            ]);
        }*/

        $user = Auth::user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        /* todo Говнокод */
        if (!is_null($request->photo1)) {
            $user->addMediaFromRequest('photo1')->toMediaCollection('payments');
        }
        if (!is_null($request->photo2)) {
            $user->addMediaFromRequest('photo2')->toMediaCollection('payments');
        }
        if (!is_null($request->photo3)) {
            $user->addMediaFromRequest('photo3')->toMediaCollection('payments');
        }
        if (!is_null($request->photo4)) {
            $user->addMediaFromRequest('photo4')->toMediaCollection('payments');
        }
        $user->save();

        $mail = trim(config('finance.payment_system_notifications_email'));
        if ($mail != '') {
            $request->merge(['email' => Auth::user()->email]);
            $content = $request->all();
            try {
                Mail::to($mail)->send(new PaymentByPaymentSystemWasMade($content));
                Log::info('Отправили письмо, что выполнен платеж  через план. систему: ' . serialize($request->except('_token')));
            } catch (Exception $ex) {
                Log::error($ex);
            }
        } else Log::warning('Не задан email для уведомления про оплату через платежные системы (PAYMENT_SYSTEM_NOTIFICATIONS_EMAIL).');

        return back()->with('flash_success', 'В ближайшее время средства будут зачислены на Ваш баланс.');
    }

    /**
     * Запрос с оплатой в другой платежной системе.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function requestOtherPaymentSystem(Request $request)
    {
        $mail = trim(config('finance.payment_system_notifications_email'));
        if ($mail != '') {
            $request->merge(['email' => Auth::user()->email]);
            $content = $request->all();
            try {
                Mail::to($mail)->send(new RequestForWithdrawalFromOtherPaymentSystem($content));
                Log::info('Отправили письмо, что выполнен запрос на ввод через не представленную у нас план. систему: ' . serialize($request->except('_token')));
            } catch (Exception $ex) {
                Log::error($ex);
            }
        } else Log::warning('Не задан email для уведомления про оплату через платежные системы (PAYMENT_SYSTEM_NOTIFICATIONS_EMAIL).');

        return back()->with('flash_success', 'Спасибо за оставленную заявку! В ближайшее время с Вами свяжется менеджер.');
    }

    /**
     * Запрос рекламных материалов
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function requestAdvertisingMaterial(Request $request)
    {
        $mail = trim(config('finance.payment_system_notifications_email'));
        if ($mail != '') {
            $request->merge(['email' => Auth::user()->email]);
            $content = $request->all();
            try {
                Mail::to($mail)->send(new RequestForAdvertisingMaterial($content));
                Log::info('Выполнен запрос на рекламный материал для ' . Auth::user()->email);
            } catch (Exception $ex) {
                Log::error($ex);
            }
        } else Log::warning('Не задан email для уведомления про оплату через платежные системы (PAYMENT_SYSTEM_NOTIFICATIONS_EMAIL).');

        return back()->with('flash_success', 'Спасибо за оставленную заявку! В ближайшее время с Вами свяжется менеджер.');
    }

    /**
     * Запрос подключения арбитражной торговли
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function arbitrationAccessRequest(Request $request)
    {
        $mail = trim(config('finance.payment_system_notifications_email'));
        if ($mail != '') {
            $request->merge(['email' => Auth::user()->email]);
            $content = $request->all();
            try {
                Mail::to($mail)->send(new ArbitrationAccessRequest($content));
                Log::info('Выполнен запрос подключения арбитражной торговли для ' . Auth::user()->email);
            } catch (Exception $ex) {
                Log::error($ex);
            }
        } else Log::warning('Не задан email для уведомления про оплату через платежные системы (PAYMENT_SYSTEM_NOTIFICATIONS_EMAIL).');

        return back()->with('flash_success', 'Спасибо за оставленную заявку! В ближайшее время с Вами свяжется менеджер.');
    }

    /**
     * Обработка формы обратной связи из лк
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendFeedbackForm(Request $request)
    {
        $mail = trim(config('app.contact_email'));
        if ($mail != '') {
            $request->merge(['email' => Auth::user()->email]);
            $content = $request->all();
            try {
                Mail::to($mail)->send(new BackendFeedback($content));
                Log::info('Отправили от формы обратной связи из лк: ' . serialize($request->except('_token')));
            } catch (Exception $ex) {
                Log::error($ex);
            }
        } else Log::warning('Не задан email для оправки (CONTACT_EMAIL).');

        return back()->with('flash_success', 'В ближайшее время с Вами свяжутся наши специалисты.');
    }

    public function showBusinessPartner()
    {
        return view('dashboard.business-partner');
    }

    public function showBaunty()
    {
        $links = BauntyLink::where('user_id', Auth()->user()->id)->OrderByDesc('id')->withTrashed()->get();
        $links->load('package');
        return view('dashboard.baunty', compact('links'));
    }

    public function saveBauntyLink(Request $request)
    {
        $this->validate($request, [
            'link' => 'required|active_url',
        ]);
        $link             = new BauntyLink;
        $link->user_id    = Auth()->user()->id;
        $link->package_id = $request->package_id;
        $link->link       = $request->link;
        if ($link->save()) {
            return back()->withErrors(['msg' => 'Ссылка сохранена.']);
        }
    }

    public function reportBaunty(Request $request)
    {
        return redirect()->back();
    }

    public function showVacancies()
    {
        return view('dashboard.vacancies');
    }

    /**
     * Для ajax запроса по адрессу home.balance.exchange
     *
     * @param Request $request
     * @return false|string
     */
    public function getRateForFront(Request $request)
    {
        try {
            $response = [
                'code'  => 'success',
                'rate'  => $this->getRate($request->currency_from, $request->currency_to),
            ];
            return json_encode($response);

        } catch (\Exception $e) {
            return json_encode([
                'code' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * По валютной паре возвращает курс обмена.
     *
     * @param $baseCurrency
     * @param $transactionCurrency
     * @return float|int
     */
    private function getRate($baseCurrency, $transactionCurrency)
    {
        // Курсы криптовалют по отношению к доллару
        // Bitcoin 1 =  18519.19 USD
        // ethereum 1 = 509.42 USD
        // Prizm 1 = 0.0071619	USD
        $rateBTC = Auth()->user()->getCurrencyeUsd('bitcoin');
        $rateETH = Auth()->user()->getCurrencyeUsd('ethereum');
        $ratePZM = Auth()->user()->getCurrencyeUsd('prizm');

        $currencyPair = $baseCurrency . '/' . $transactionCurrency;

        switch ($currencyPair) {
            case 'USD/BTC':
                $rate = 1 / $rateBTC;
                break;
            case 'USD/ETH':
                $rate = 1 / $rateETH;
                break;
            case 'USD/PZM':
                $rate = 1 / $ratePZM;
                break;
            case 'PZM/USD':
                $rate = $ratePZM;
                break;
            case 'PZM/BTC':
                $rate = $ratePZM / $rateBTC;
                break;
            case 'PZM/ETH':
                $rate = $ratePZM / $rateETH;
                break;
            case 'ETH/USD':
                $rate = $rateETH;
                break;
            case 'ETH/BTC':
                $rate = $rateETH / $rateBTC;
                break;
            case 'ETH/PZM':
                $rate = $rateETH / $ratePZM;
                break;
            case 'BTC/USD':
                $rate = $rateBTC;
                break;
            case 'BTC/ETH':
                $rate = $rateBTC / $rateETH;
                break;
            case 'BTC/PZM':
                $rate = $rateBTC / $ratePZM;
                break;
            default:
                $rate = 0;
        }

        return $rate;
    }

    public function exchange(StoreExchange $request)
    {
        // Значения из полей формы
        $currencyFrom = $request->currency_from; // PZM
        $amountFrom = $request->amount_from; // 300
        $currencyTo = $request->currency_to; // USD
        $amountTo = $request->amount_to; // 1.4486148864000001
        $rate = $request->rate; // 0.0048774912

        // Формируем имена балансов
        $balanceNameFrom = 'balance_' . strtolower($currencyFrom); // balance_pzm
        $balanceNameTo = 'balance_' . strtolower($currencyTo); // balance_usd

        // Текущие суммы на балансе
        $userBalanceFrom = Auth::user()->$balanceNameFrom;
        $userBalanceTo = Auth::user()->$balanceNameTo;

        // Нельзя менять валюту на такую же точно валюту.
        if ($currencyFrom == $currencyTo) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(__('base.dash.balance.exchange.identical_currencies', ['balance_name' => $currencyFrom]));
        }

        // Если списываемая сумма больше или равна балансу пользователя.
        if ($amountFrom >= $userBalanceFrom) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(__('base.dash.balance.exchange.not_enough_money', ['balance_name' => $currencyFrom]));
        }

        try {
            DB::beginTransaction();

//            User::find(Auth::id())->update([
//                $balanceNameFrom => $userBalanceFrom - $amountFrom,
//                $balanceNameTo => $userBalanceTo + $amountTo,
//            ]);

            $exchange = new Exchange();
            $exchange->balance_from = $currencyFrom;
            $exchange->amount_from = $amountFrom;
            $exchange->balance_to = $currencyTo;
            $exchange->amount_to = $amountTo;
            $exchange->rate = $rate;
            $exchange->user_id = Auth::id();
            $exchange->save();

            // Формируем имена полей для таблицы транзакций.
            $fieldAmountFrom = 'amount_' . strtolower($currencyFrom);
            $fieldAmountTo = 'amount_' . strtolower($currencyTo);
            $fieldBalanceCurrencyFromAfterTransaction = 'balance_' . strtolower($currencyFrom) . '_after_transaction';
            $fieldBalanceCurrencyToAfterTransaction = 'balance_' . strtolower($currencyTo) . '_after_transaction';

//            throw new Exception(strtolower( $currencyFrom ) . '/' . strtolower( $currencyTo ));

            $transaction = new Transaction;
            $transaction->user_id = Auth()->user()->id;
            $transaction->transaction_type_id = TransactionsTypesConsts::EXCHANGE;
            $transaction->$fieldAmountFrom = $amountFrom;
            $transaction->$fieldAmountTo = $amountTo;
            $transaction->$fieldBalanceCurrencyFromAfterTransaction = $userBalanceFrom - $amountFrom;
            $transaction->$fieldBalanceCurrencyToAfterTransaction = $userBalanceTo + $amountTo;
            $transaction->rate = $rate;
            $transaction->exchange_direction = strtolower( $currencyFrom ) . '/' . strtolower( $currencyTo );
            $transaction->save();

            $alert = new Alert;
            $alert->user_id = Auth()->user()->id;
            $alert->alert_id = AlertType::EXCHANGE;
            $alert->email = Auth()->user()->email;
            $alert->amount = $amountFrom;
            $alert->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($e->getMessage());
        }

        return redirect()->back();
    }

    public function showPartnersMapPage()
    {
        $partners = Partner::whereNotNull('coordinates')->get();
        $partnersMap = Map::find(1);

        return view('dashboard.partners-map', compact('partners', 'partnersMap'));
    }

    public function showMaterialsPage()
    {
        $companyMaterials = CompanyMaterial::all('name', 'describe', 'pdf');
        return view('dashboard.materials.main', compact('companyMaterials'));
    }



}
