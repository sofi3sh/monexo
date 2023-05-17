<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    'level'    => 'Level: ',
    'achieved_level' => 'Achieved Level: ',

    'header' => [
        'title'                 => 'Earn money with your company using your personal account',
        'home'                  => 'Home',
        'registration'          => 'Registration',
        'login'                 => 'Login',
        'password_recovery'     => 'Password recovery',
        'back_to_the_main_page' => 'Back to the main page',
        'to_cab'                => 'Go to the cabinet'

    ],
    'login' => [
        'login_with'  => 'Login with',
        'or_login_lp' => 'Or login with username / password',
        'email'       => 'Email',
        'password'    => 'Password',
        'button'      => 'Login',
        'register'    => 'Registration',
        'f_psw'       => 'Forgot your password?',
    ],
    'register' => [
        'login_with'   => 'Login with',
        'or_login_lp'  => 'Registration form',
        'name'         => 'Name',
        'surname'      => 'Surname',
        'email'        => 'Email',
        'country'      => 'Country',
        'city'         => 'City',
        'age'          => 'Age',
        'phone'        => 'Phone',
        'password'     => 'Password',
        'rst_password' => 'Password Confirmations',
        'terms'        => [
            'read' => 'Read the terms of use',
            'rules' => 'terms of use',
            'start' => 'I agree with',
            'end' => 'terms of use'
        ],
        'button'       => "Sign up",
        'errors' => 'Errors'
    ],
    'phone_verify' => [
        'confirm' => 'Confirm',
        'code_invalid' => 'The code you entered is invalid',
        'remember' => 'Remember for '.config('auth.phone_verification_code.remember_days') . ' days',
    ],
    'password_recovery' => [
        'change_password' => 'Change password',
        'email'           => 'Email',
        'reset_link'      => 'We have e-mailed your password reset link!',
        'invalid_email'   => 'User with email :email not found.',
    ],
    'btns' => [
        'query_email' => 'Query email',
        'close' => 'Close',
    ]
];
