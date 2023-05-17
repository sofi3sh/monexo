<?php

namespace App\Http\Controllers\Backend\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Profile\UpdatePassword;
use App\Models\Home\Currency;
use App\Models\UserStatisticFull;
use App\Services\PhoneVerification\PhoneVerification;
use App\Services\PhoneVerification\Requests\ChangePhoneRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Backend\Profile\StoreProfile;
use App\Models\BuyPartnersMapApp;
use App\Models\BuyPartnersMapSetting;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\Home\UserPaymentDetail;
use DB;
use Illuminate\Support\Facades\Log;
use App\Models\Home\Wallet;
use App\Models\NewsSubscribe;
use App\Models\VerifAnketAnswer;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Session;

class ProfileController extends Controller
{
    /**
     * Отображает страницу настроек.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showProfilePage()
    {
        $wallets = $this->getWallets(Auth::user()->id);

        // Рассылка новостей
        $user =  Auth::user();
        $email = $user->email;
        $unsubscribeURL  = URL::signedRoute('website.news-unsubscribe.show', compact('email'));
        $subscribe = NewsSubscribe::where('email', $email)->first();
        // Карта партнеров
        $mapSettings = BuyPartnersMapSetting::find(1);
        $mapApp = BuyPartnersMapApp::where('user_id', Auth::user()->id)->first();
        $mapDate = Carbon::parse($mapApp->updated_at ?? null)->addDays(30)->format('d.m.y') ?? null;

        // Статистика пользователя
        $userStatisticFull = new UserStatisticFull( Auth::user() );
        $profitAffiliateProgram = number_format( $userStatisticFull->getProfitAffiliateProgram(), 2 );
        $quantityReferrals = $userStatisticFull->getReferralsCount();
        $teamTurnover = number_format( $userStatisticFull->teamTurnover(), 2);

        $showVerifAnket = VerifAnketAnswer::where([
            'is_check' => 0,
            'user_id' => $user->id
        ])
        ->orderBy('created_at', 'DESC')
        ->first() ? false : true;
        
        $showVerifAnket = $showVerifAnket && !$user->is_verif && (Carbon::parse($user->created_at, 'Y-m-d H:i:s') < Carbon::createFromTimeString('2021-04-06 00:00:00'));

        $qr_code = '';
        $secret  = '';
        if (!$user->twofa_secret) {
            $google2fa = app('pragmarx.google2fa');
            // generate a secret
            $secret = $google2fa->generateSecretKey();
            // generate the QR code, indicating the address
            // of the web application and the user name
            // or email in this case
            $qr_code = $google2fa->getQRCodeInline(
                config('app.name'),
                $user->email,
                $secret
            );
            // store the current secret in the session
            // will be used when we enable 2FA (see below)
            session([ "2fa_secret" => $secret]);
        }

        return view('dashboard.settings', compact(
            'wallets',
            'subscribe',
            'unsubscribeURL',
            'mapSettings',
            'mapApp',
            'mapDate',
            'teamTurnover',
            'profitAffiliateProgram',
            'quantityReferrals',
            'showVerifAnket',
            "qr_code",
            "secret",
        ));
    }

    public function personalUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:150',
            'surname' => 'string|min:2|max:150',
            'email' => 'string|email|max:190',
            'phone' => 'string|max:30',
            'country' => 'string|min:2|max:190',
            'city' => 'string|min:2|max:50',
            'date_birthday' => 'string|min:2|max:12',
          ]);
        if ($validator->fails()) {
            return redirect()
                        ->route('home.profile.profile')
                        ->withErrors($validator)
                        ->with('page','personal');
        }

        $telegramVerificationRequired = $request->has('telegram_verification_required');

        $user = Auth::user();

        // Предотвращение изменения почты
        if ($user->registeredViaGoogle()) {
            $request->merge(['email' => $user->email]);
        }

        $user->name = $request->name;
        $user->city = $request->city;
        $user->date_birthday = Carbon::parse($request->date_birthday);
        $user->surname = $request->surname;
        if($user->email !== $request->email) $user->email = $request->email;
        $user->phone = $request->phone;
        $user->country = $request->country;
        $user->telegram_verification_required = $telegramVerificationRequired;

        if (!$user->telegram_verification_required and $telegramVerificationRequired) {
            $user->telegram_id = null;
            $user->telegram_verification_status = false;
        }

        try{
            $user->save();
            return redirect()->route('home.profile.profile')->with('page','personal');
        }catch(\Exception $e) {
            return redirect()->route('home.profile.profile')
                                ->with('page','personal')
                                ->withErrors(trans('validation.email-in-use'));
        }

    }
    public function paymentsUpdate(Request $request)
    {
        $this->setWallets($request->all());
      //  updateOrCreate
        return redirect()->route('home.profile.profile')->with('page','payments');
    }

    public function passwordUpdate(Request $request)
    {
        $authUser = Auth::user();

         $rules = [
             'new_password' => 'required|string|min:6|confirmed',
         ];

         // Если пользователь зарегистрирован через соц сеть, у него не будет пароля
         if ($authUser->password) {
             $rules['current_password'] = [
                 'required',
                 function ($attribute, $value, $fail) use ($authUser) {
                     if (!Hash::check($value, $authUser->password)) {
                         return $fail(__('The current password does not match'));
                     }
                 }
             ];
         }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()
                ->route('home.profile.profile')
                ->withErrors($validator)
                ->with('page', 'password');
        }

        $authUser->update([
            'password' => Hash::make($request->post('new_password')),
        ]);

        return redirect()
            ->route('home.profile.profile')
            ->with([
                'status' => __('Password successfully changed'),
                'page' => 'password',
            ]);
    }

    /**
     * check the submitted OTP
     * if correct, enable 2FA
     */
    public function twofaDisable(Request $request)
    {
        $google2fa = app('pragmarx.google2fa');
        $google2fa->setEnforceGoogleAuthenticatorCompatibility(false);

        $user = Auth::user();
        $user->twofa_secret = null;
        $user->save();

        return redirect(route('home.profile.profile'));
    }

    /**
     * check the submitted OTP
     * if correct, enable 2FA
     */
    public function twofaEnable(Request $request)
    {
        $google2fa = app('pragmarx.google2fa');

        // retrieve secret from the session
        $secret = session("2fa_secret");
        $user = Auth::user();

        if ($google2fa->verify($request->input('otp'), $secret)) {
            // store the secret in the user profile
            // this will enable 2FA for this user
            $user->twofa_secret = $secret;
            $user->save();

            // avoid double OTP check
            session(["2fa_checked" => true]);

            return redirect(route('home.profile.profile'));
        }

        throw ValidationException::withMessages([
            'otp' => __('base.dash.settings.2fa.incorrect-2fa-code')
        ]);
    }

    private function getWallets($user_id)
    {
        $w = Wallet::where('user_id',$user_id)->get();

        /*$c = Currency::where('name','Payeer USD')->first();
        $d = $w->where('currency_id',$c['id'])->first();
        $wallets['payeer'] = is_null($d)?'':$d->address;

        $c = Currency::where('name','Perfect Money')->first();
        $d = $w->where('currency_id',$c['id'])->first();
        $wallets['pm'] = is_null($d)?'':$d->address;*/

        $c = Currency::where('name','Tether')->first();
        $d = $w->where('currency_id',$c['id'])->first();
        $wallets['tether'] = is_null($d)?'':$d->address;

        $c = Currency::where('name','Bitcoin')->first();
        $d = $w->where('currency_id',$c['id'])->first();
        $wallets['btc'] = is_null($d)?'':$d->address;

        $c = Currency::where('name','Ethereum')->first();
        $d = $w->where('currency_id',$c['id'])->first();
        $wallets['eth'] = is_null($d)?'':$d->address;

        /*$c = Currency::where('name','Litecoin')->first();
        $d = $w->where('currency_id',$c['id'])->first();
        $wallets['ltc'] = is_null($d)?'':$d->address;*/

        $c = Currency::where('name','MasterCard (USD)')->first();
        $d = $w->where('currency_id',$c['id'])->first();
        $wallets['card'] = is_null($d)?'':$d->address;

        return $wallets;
    }
    private function setWallets($data)
    {
        foreach($data as $k=>$v){
            $data[$k] = is_null($v)?'':$v;
        }
        $id = Auth::user()->id;
            /*$c = Currency::where('name','Payeer USD')->first();
            Wallet::updateOrCreate(['user_id'=>$id,'currency_id'=>$c['id']],
                                   ['address'=>$data['payeer'],'wallet_type_id'=>2]);

            $c = Currency::where('name','Perfect Money')->first();
            Wallet::updateOrCreate(['user_id'=>$id,'currency_id'=>$c['id']],
                                   ['address'=>$data['pm'],'wallet_type_id'=>2]);*/

            $c = Currency::where('name','Bitcoin')->first();
            Wallet::updateOrCreate(['user_id'=>$id,'currency_id'=>$c['id']],
                                   ['address'=>$data['btc'],'wallet_type_id'=>2]);

            $c = Currency::where('name','Ethereum')->first();
            Wallet::updateOrCreate(['user_id'=>$id,'currency_id'=>$c['id']],
                                   ['address'=>$data['eth'],'wallet_type_id'=>2]);

            /*$c = Currency::where('name','Litecoin')->first();
            Wallet::updateOrCreate(['user_id'=>$id,'currency_id'=>$c['id']],
                                   ['address'=>$data['ltc'],'wallet_type_id'=>2]);*/

            $c = Currency::where('name','MasterCard (USD)')->first();
            Wallet::updateOrCreate(['user_id'=>$id,'currency_id'=>$c['id']],
                                   ['address'=>$data['card'],'wallet_type_id'=>2]);

    }

    public function updateNewsSubscribe(Request $request)
    {
        $validatedData = $request->validate([
            'period' => [
                'required',
                Rule::in(['month', 'week', 'never'])
            ]
        ]);
        $user =  Auth::user();
        $email = $user->email;

        $news = NewsSubscribe::where('email', $email)->first();

        DB::beginTransaction();
        if($news !== null){
            try {
                $news->period = $validatedData['period'];
                $news->save();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->withErrors($e);
            }

        }
        else {
            try {
                NewsSubscribe::insert([
                    'period' => $validatedData['period'],
                    'user_id' => $user->id,
                    'email' => $email,
                ]);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->withErrors($e);
            }
        }

        Session::flash('status', 'Вы успешно изменили период отправки новостей');

        return redirect()->back();
    }




    /**
     * Отображает страницу Трейдинг.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showTradingPage()
    {
        return view('backend.pages.profile.trading');
    }

    /**
     * Обновление данных трейднига.
     *
     * @param $request
     * @return mixed
     */
    public function pathTradingPage(Request $request)
    {

    }

    public function showChangePasswordPage()
    {
        return view('backend.pages.profile.password');
    }

    public function showRequisitesPage()
    {
        return view('backend.pages.profile.requisites')
            ->with([
                'user' => Auth::user()
            ]);
    }

    /**
     * Сохранение данных о платежных системах с профиля
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRequisitesPage(Request $request)
    {
        Auth::user()->fill(
            [
                'visa'        => $request->visa,
                'mastercard'  => $request->mastercard,
                'qiwi'        => $request->qiwi,
                'webmoney'    => $request->webmoney,
                'yandexMoney' => $request->yandexMoney,
            ]
        )->save();

        return back()->with('flash_success', 'Данные успешно обновлены.');
    }

    public function show2faPasswordPage()
    {
        return view('backend.pages.profile.2fa');
    }

    public function pathAuthUserPassword(UpdatePassword $request)
    {
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with([
            'flash_success' => 'Пароль успешно имзенен.',
        ]);
    }

    /**
     * Обновление данных профиля - имя, фамилия и телефон.
     *
     * @param StoreProfile $request
     * @return mixed
     */
    public function patchProfilePage(StoreProfile $request)
    {
        $user = Auth::user();
        $user->name    = $request->name;
        $user->phone   = $request->phone;
        $user->age     = $request->age;
        $user->country = $request->country;

        $user->save();

        return back()->with([
            'flash_success' => 'Профиль успешно обновлен',
        ]);
    }

    /**
     * Обновление данных профиля - имя, фамилия и телефон.
     *
     * @param StoreProfile $request
     * @return mixed
     */
    public function patchProfileAvatar(Request $request)
    {
        $rules = array(
            'avatar' => 'mimes:jpeg,jpg,png,gif|required|max:1000000' // max 1000kb
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->with([
                'flash_danger' => __('validation.custom.image.common_error'),
            ]);
        }

        $user = Auth::user();

        if (!is_null($request->avatar)) {
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        }
        $user->save();

        return back()->with([
            'flash_success' => 'Профиль успешно обновлен',
        ]);
    }

    public function updatePartnersMapApp(Request $request)
    {

        $data = $request->validate([
            'id' => 'required|integer',
            'is_active' => 'required|integer|min:0|max:1'
        ]);

        DB::beginTransaction();
        try {
            $app = BuyPartnersMapApp::find($data['id']);
            $app->is_active = $data['is_active'];
            $app->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
        if(!$data['is_active']){
            Session::flash('success', 'Вы успешно отказались от подписки на карту партнеров');
        }
        else {
            Session::flash('success', 'Вы успешно создали заявку на добавление на карту партнеров (30 дней)');
        }

        return redirect()->back();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendPhoneVerificationSms(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'result' => (new PhoneVerification())->sendVerificationCode(auth()->user(), request()->input('phone'))
        ]);
    }

    /**
     * @param ChangePhoneRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function phoneUpdate(ChangePhoneRequest $request): \Illuminate\Http\RedirectResponse
    {
        $result = auth()->user()->changePhone(request()->input('code'), request()->input('phone'));

        if (!$result) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['code' => __('auth.phone_verify.code_invalid')]);
        } else {
            return redirect()->back();
        }
    }
}
