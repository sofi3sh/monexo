<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Backend\Pages\MarketingPlanController;
use App\Models\Home\ReferralDeposit;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\Frontend\Auth\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Lang;
use Dok5\Referrals\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Home\Alert;
use App\Models\Consts\AlertType;
use App\Models\NewsSubscribe;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Carbon;
use App\Models\Home\MarketingPlan;
use App\Repositories\UserIp\UserIpRepositoryInterface;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use Referral;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * @var UserIpRepositoryInterface
     */
    protected UserIpRepositoryInterface $userIpRepository;


    /**
     * Create a new controller instance.
     *
     * @param UserIpRepositoryInterface $userIpRepository
     */
    public function __construct(UserIpRepositoryInterface $userIpRepository)
    {
        $this->userIpRepository = $userIpRepository;
        $this->middleware('guest')->except('cancelRegistration');
        $this->middleware('referral')->only('create');
    }

    /**
     * Show the application registration form.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegistrationForm(Request $request)
    {
        // Получаем рефера по чьей реферальной ссылке регистрируется пользователь
        //$refer = $this->getReferralUser();
        $refer = (is_null($this->getReferralUserId()))?1:$this->getReferralUserId();
        $user_refer = User::find($refer);
        $page = __('auth.header.registration');

        $referralEmail      = isset($request->referral_email) ? $request->referral_email : null;
        $depositAmount      = isset($request->depositAmount) ? $request->depositAmount : null;
        $package            = isset($request->package) ? $request->package : null;
        $referralDepositId  = isset($request->referral_deposit_id) ? $request->referral_deposit_id : null;

        $referralDepositId = null;
        $referralNewEmail = null;
        if ( isset($request->referral_deposit_id) ) {
            $referralDepositId  = $request->referral_deposit_id;
            $referralNewEmail = ReferralDeposit::on()->where('id', $referralDepositId )->first()->referral_email;
        }

        return view('auth.register', compact(
            'refer',
            'user_refer',
            'page',
            'referralEmail',
            'referralDepositId',
            'depositAmount',
            'package',
            'referralNewEmail')
        );
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     * @throws \Exception
     */
    protected function create(array $data)
    {
//        $refCode = $this->getGeneratedReferralCode();
//        $specifiedReferralId = $this->getReferralUserId();
//        $referralId = is_null($specifiedReferralId) ?
//            (User::where('id', '1')->exists() ? 1 : null) :
//            $specifiedReferralId;
        $refCode = $this->getGeneratedReferralCode();
        $specifiedReferralId = $this->getReferralUserId();

        if ( is_null($specifiedReferralId) ) {
            if ( isset($data['referral_deposit_id']) && ! empty($data['referral_deposit_id']) ) {
                $referralId = ReferralDeposit::on()->find( $data['referral_deposit_id'] )->pluck('user_id')->first();
            } elseif ( User::where('id', '1')->exists() ) {
                $referralId = 1;
            } else {
                $referralId = null;
            }
        } else {
            $referralId = $specifiedReferralId;
        }

        //реферали 2 и 3 линии
        if ($referralId == 1) {
            $referralSecondId = 1;
            $referralThirdId = 1;
            }  else {
                $referralSecondParent = User::where('id', $referralId)->first();
                $referralSecondId = $referralSecondParent->parent_id;
                if ($referralSecondId == 1) {
                    $referralThirdId = 1;
                    } else {
                        $referralThirdParent = User::where('id', $referralSecondId)->first();
                        $referralThirdId = $referralThirdParent->parent_id;
                    }
            }



//        referral_deposit_id
        $user = User::create([
            'name'               => $data['name'],
            'surname'            => $data['surname'],
            'email'              => $data['email'],
            'phone'              => $data['phone'] ?? null,
            'country'            => $data['country'],
            'age'                => $data['age'] ?? null,
            'date_birthday'      => $data['birthday'] ? Carbon::parse($data['birthday']) : null,
            'city'               => $data['city'],
            //            'add_contact'        => $data['add_contact'],
            'locale'             => Lang::locale(),
            'ref_code'           => $refCode,
            'is_trading_account' => array_key_exists('is_trading_account', $data) ? true : false,
            'parent_id'          => $referralId, //Если пользователь пришел не по реф. ссылке - помещаем под user_id=1

            'parent_second_id'   => $referralSecondId,
            'parent_third_id'    => $referralThirdId,

            'password'           => Hash::make($data['password']),
        ]);

        // TODO изменить на инвайт из почты
//        if ($specifiedReferralId && $parent = User::find($specifiedReferralId)) {
//            UserMarketingPlan::addInvitationMarketingPlan($user, $parent);
//        }

        $email = $data['email'];

        $subscribeSettings = NewsSubscribe::where('email', $email)->first();

        if($subscribeSettings !== null) {
            DB::beginTransaction();
            try {
                $subscribeSettings->user_id = $user->id;
                $subscribeSettings->save();
                DB::commit();

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error($e);
            }
        }

        $parents = $user->getAllLevelsParent();

        foreach($parents as $p){
            $alert                = new Alert;
            $alert->user_id       = $p['id'];
            $alert->alert_id      = AlertType::REGISTER_NEW_PARTNER;
            $alert->email         = $data['email'];
            $alert->save();
        }
        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        // Создаем запись в журнале IP адресов
        $this->userIpRepository->insertRegister($this->guard()->user(), $request->ip());

        \Cookie::forget(config('referrals.referralCookieKey'));

        if ( isset( $request->referral_deposit_id ) && ( ! is_null( $request->referral_deposit_id ) ) ) {

            $referralDeposit = ReferralDeposit::on()->find( $request->referral_deposit_id );

            // is_accrued 0 - не зачисленно реферралу, 1 - зачислено.
            // reset_invite_is 0 - инвайт не был отменен, 1 - его отменил крон
            if ( $referralDeposit->is_accrued === 0 && $referralDeposit->reset_invite_is === 0 ) {

                Alert::insert([
                    'user_id' => $referralDeposit->user_id,
                    'email' => User::find($referralDeposit->user_id)->email,
                    'amount' => $referralDeposit->amount_usd,
                    'alert_id' => AlertType::INVITE_OPEN_DEPOSIT,
                    'add_info' => null,
                    'currency_type' => 'usd',
                    'marketing_plan_id' => null,
                    'created_at' => \Carbon\Carbon::now(),
                ]);

                if ( $referralDeposit->amount_usd > 0 ) {
                    $newUser = Auth::user();
                    $marketingPlan = MarketingPlan::find($referralDeposit->marketing_plan_id);
                    $investUSD = $referralDeposit->amount_usd;
                    $daysDiff = 0;
                    $discountUSD = 0;
                    $parentId = $referralDeposit->user_id;
                    MarketingPlanController::createMarketingPlan($newUser, $marketingPlan, $investUSD, $daysDiff, $discountUSD, $parentId);
                }
                // 0 - не зачисленно реферралу, 1 - зачислено.
                $referralDeposit->update( ['is_accrued' => 1] );
            }
        }

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Запрос на повторную отправку email.
     *
     */
    public function registerQueryEmail()
    {
        return view('auth.verify');
    }

    /**
     * Cancel registration.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function cancelRegistration(Request $request)
    {
        if ($request->user() instanceof MustVerifyEmail && !$request->user()->hasVerifiedEmail()) {
            $request->user()->forceDelete();
        }

        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('');
    }
}
