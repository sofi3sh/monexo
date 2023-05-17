<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Notifications\RegisteredViaSocialNetwork;
use App\Http\Controllers\Controller;
use App\Repositories\UserIp\UserIpRepositoryInterface;
use App\Services\PhoneVerification\PhoneVerification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;
use Dok5\Referrals\Referral;
use Illuminate\Support\Facades\Lang;
use Carbon\Carbon;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    use Referral;

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    protected function redirectTo() {
        $toPage = request()->toPage;

        if($toPage !== NULL) {
            return route($toPage);
        }

        return route('home.main');
    }

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
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @param Request $request
     * @return Application|Factory|Response|View
     */
    public function showLoginForm(Request $request)
    {
        $page = __('auth.header.login');
        $toPage = $request->toPage;
        return view('auth.login', compact('page', 'toPage'));
    }

    private function isActiveUser( string $email ): bool
    {
        $user = User::on()->where('email', $email)->first();
        if ( ! is_null( $user ) ) {
            if ( $user->is_active === 1 ) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ( ! $this->isActiveUser( $request->email ) ) {
            return $this->sendFailedLoginResponse($request);
        }

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {

            // Создаем запись в журнале IP адресов
            $this->userIpRepository->insertAuth($this->guard()->user(), $request->ip());

            // Проверяем актуальность верификации телефона
            if (!$this->guard()->user()->hasActualVerification()) {
                $this->guard()->user()->markPhoneAsNotVerified();
            }

            $this->guard()->user()->markTelegramAsNotVerified();

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {
        $rules = [
            $this->username() => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => 'recaptcha',
        ];

        // отключение капчи для локальных окружений
        if (\App::isLocal()) {
            unset($rules['g-recaptcha-response']);
        }

        $request->validate($rules);
    }

    /**
      * Redirect the user to the Google authentication page.
      *
      * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function handleProviderCallback()
    {
        $refCode = $this->getGeneratedReferralCode();
        $referralId = (is_null($this->getReferralUserId()))?1:$this->getReferralUserId();

        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }
        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $newUser                     = new User;
            $newUser->name               = $user->name;
            $newUser->email              = $user->email;
            $newUser->google_id          = $user->id;
            $newUser->locale             = Lang::locale();
            $newUser->ref_code           = $refCode;
            $newUser->parent_id          = $referralId; //$this->getReferralUserId() ?? 1, //Если пользователь пришел не по реф. ссылке - помещаем под user_id=1
            $newUser->email_verified_at  = Carbon::now();
            $newUser->save();
            auth()->login($newUser, true);

            $newUser->notify(new RegisteredViaSocialNetwork);
        }
        return redirect()->to('/home');
    }
}
