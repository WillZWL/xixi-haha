<?php

namespace App\Http\Controllers\Auth;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @param \Illuminate\Contracts\Auth\Guard          $auth
     * @param \Illuminate\Contracts\Auth\PasswordBroker $passwords
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
