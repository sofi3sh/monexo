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

    'failed' => 'Неверный адрес электронной почты или пароль',
    'throttle' => 'Слишком много попыток. Пожалуйста, попробуйте через :seconds секунды.',
    'level'    => 'Уровень: ',
    'achieved_level' => 'Достигнутый Уровень: ',

    'header' => [
        'title'                 => 'Зарабатывайте вместе с компанией, используя личный кабинет',
        'home'                  => 'Главная',
        'registration'          => 'Регистрация',
        'login'                 => 'Авторизация',
        'password_recovery'     => 'Восстановление пароля',
        'back_to_the_main_page' => 'Вернуться на главную',
        'to_cab'                => 'Перейти в кабинет'
    ],
    'login' => [
        'login_with'  => 'Войти через',
        'or_login_lp' => 'Или войти по логину/паролю',
        'email'       => 'Электронная почта',
        'password'    => 'Пароль',
        'button'      => 'Войти',
        'register'    => 'Зарегистрироваться',
        'f_psw'       => 'Забыли пароль?',
    ],
    'register' => [
        'login_with'   => 'Войти через',
        'or_login_lp'  => 'Форма регистрации',
        'name'         => 'Имя',
        'surname'      => 'Фамилия',
        'email'        => 'Электронная почта',
        'country'      => 'Страна',
        'city'         => 'Город',
        'age'          => 'Возраст',
        'phone'        => 'Телефон',
        'password'     => 'Пароль',
        'rst_password' => 'Подтверждение пароля',
        'terms'        => [
            'read' => 'Ознакомьтесь с',
            'rules' => 'правилами использования',
            'start' => 'Я принимаю',
            'end' => 'правила использования'
        ],
        'button'       => "Зарегистрироваться",
        'errors' => 'Ошибки'
    ],
    'phone_verify' => [
        'confirm' => 'Подтвердить',
        'code_invalid' => 'Введенный вами код недействителен',
        'remember' => 'Запомнить на '.config('auth.phone_verification_code.remember_days') . ' дней',
    ],
    'add-phone' => [
        'title' => 'Необходим ваш актуальный номер телефона для двухфакторной авторизации'
    ],
    'password_recovery' => [
        'change_password' => 'Сменить пароль',
        'email'           => 'Электронная почта',
        'reset_link'      => 'Мы отправили вам ссылку для сброса пароля по электронной почте!',
        'invalid_email'   => 'Пользователь с почтой :email не найден.',
    ],
    'btns' => [
        'query_email' => 'Запросить письмо',
        'close' => 'Закрыть',
    ]
];
