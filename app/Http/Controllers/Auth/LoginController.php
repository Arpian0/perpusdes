<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\CartManagerController;
use App\Models\Reward;
use App\Models\RewardAccounting;
use App\Models\UserSession;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/panel';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $seoSettings = getSeoMetas('login');
        $pageTitle = !empty($seoSettings['title']) ? $seoSettings['title'] : trans('site.login_page_title');
        $pageDescription = !empty($seoSettings['description']) ? $seoSettings['description'] : trans('site.login_page_title');
        $pageRobot = getPageRobot('login');

        $data = [
            'pageTitle' => $pageTitle,
            'pageDescription' => $pageDescription,
            'pageRobot' => $pageRobot,
        ];

        return view(getTemplate() . '.auth.login', $data);
    }

    public function login(Request $request)
    {
        $rules = [
            'username' => 'required|numeric',
            'password' => 'required|min:6',
        ];

        if ($this->username() == 'email') {
            $rules['username'] = 'required|email';
        }

        if (!empty(getGeneralSecuritySettings('captcha_for_login'))) {
            $rules['captcha'] = 'required|captcha';
        }

        $this->validate($request, $rules);

        if ($this->attemptLogin($request)) {
            return $this->afterLogged($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        $user = auth()->user();

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if (!empty($user) and $user->logged_count > 0) {
            $user->update([
                'logged_count' => $user->logged_count - 1
            ]);
        }

        return redirect('/');
    }

    public function username()
    {
        $email_regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";

        if (empty($this->username)) {
            $this->username = 'mobile';
            if (preg_match($email_regex, request('username', null))) {
                $this->username = 'email';
            }
        }
        return $this->username;
    }

    protected function attemptLogin(Request $request)
    {
        $credentials = [
            $this->username() => $request->get('username'),
            'password' => $request->get('password')
        ];
        $remember = true;

        /*if (!empty($request->get('remember')) and $request->get('remember') == true) {
            $remember = true;
        }*/

        return $this->guard()->attempt($credentials, $remember);
    }

    public function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'username' => [trans('validation.password_or_username')],
        ]);
    }

    protected function sendBanResponse($user)
    {
        throw ValidationException::withMessages([
            'username' => [trans('auth.ban_msg', ['date' => dateTimeFormat($user->ban_end_at, 'j M Y')])],
        ]);
    }

    protected function sendNotActiveResponse($user)
    {
        $toastData = [
            'title' => trans('public.request_failed'),
            'msg' => trans('auth.login_failed_your_account_is_not_verified'),
            'status' => 'error'
        ];

        return redirect('/login')->with(['toast' => $toastData]);
    }

    protected function sendMaximumActiveSessionResponse()
    {
        $toastData = [
            'title' => trans('update.login_failed'),
            'msg' => trans('update.device_limit_reached_please_try_again'),
            'status' => 'error'
        ];

        return redirect('/login')->with(['login_failed_active_session' => $toastData]);
    }

    public function afterLogged(Request $request, $verify = false)
    {
        $user = auth()->user();

        if ($user->ban) {
            $time = time();
            $endBan = $user->ban_end_at;
            if (!empty($endBan) and $endBan > $time) {
                $this->guard()->logout();
                $request->session()->flush();
                $request->session()->regenerate();

                return $this->sendBanResponse($user);
            } elseif (!empty($endBan) and $endBan < $time) {
                $user->update([
                    'ban' => false,
                    'ban_start_at' => null,
                    'ban_end_at' => null,
                ]);
            }
        }

        if ($user->status != User::$active and !$verify) {
            $this->guard()->logout();
            $request->session()->flush();
            $request->session()->regenerate();

            $verificationController = new VerificationController();
            $checkConfirmed = $verificationController->checkConfirmed($user, $this->username(), $request->get('username'));

            if ($checkConfirmed['status'] == 'send') {
                return redirect('/verification');
            }
        } elseif ($verify) {
            session()->forget('verificationId');

            $user->update([
                'status' => User::$active,
            ]);

            $registerReward = RewardAccounting::calculateScore(Reward::REGISTER);
            RewardAccounting::makeRewardAccounting($user->id, $registerReward, Reward::REGISTER, $user->id, true);
        }

        if ($user->status != User::$active) {
            $this->guard()->logout();
            $request->session()->flush();
            $request->session()->regenerate();

            return $this->sendNotActiveResponse($user);
        }

        $checkLoginDeviceLimit = $this->checkLoginDeviceLimit($user);
        if ($checkLoginDeviceLimit != "ok") {
            $this->guard()->logout();
            $request->session()->flush();
            $request->session()->regenerate();

            return $this->sendMaximumActiveSessionResponse();
        }

        $user->update([
            'logged_count' => (int)$user->logged_count + 1
        ]);

        $cartManagerController = new CartManagerController();
        $cartManagerController->storeCookieCartsToDB();

        if ($user->isAdmin()) {
            return redirect(getAdminPanelUrl() . '');
        } else {
            return redirect('/panel');
        }
    }

    private function checkLoginDeviceLimit($user)
    {
        $securitySettings = getGeneralSecuritySettings();

        if (!empty($securitySettings) and !empty($securitySettings['login_device_limit'])) {
            $limitCount = !empty($securitySettings['number_of_allowed_devices']) ? $securitySettings['number_of_allowed_devices'] : 1;

            $count = $user->logged_count;

            if ($count >= $limitCount) {
                return "no";
            }
        }

        return 'ok';
    }
}
