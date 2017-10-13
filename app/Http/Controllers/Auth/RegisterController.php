<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests\User\PasswordRequest;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Auth
 */
class RegisterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegistrationForm(Request $request)
    {
        $code = $request->route('code');
        try {
            if(!$this->getUserRegistratorService()->isValidInviteCode($code)) {
                abort(404);
            }
        } catch (\Exception $e) {
            abort(404);
        }

        return view('auth.register', ['code' => $code]);
    }

    /**
     * @param PasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(PasswordRequest $request)
    {
        $code = $request->route('code');
        $data = $request->all();
        try {
            $user = $this->getUserRegistratorService()->setPassword($code, $data['password']);
        } catch (\Exception $e) {
            Log::error($e);
            abort(404);
        }

        $this->guard()->login($user);

        return redirect()->route('main');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * @return \App\Service\UserRegistrator
     */
    protected function getUserRegistratorService()
    {
        return App::make('user_registrator');
    }
}
