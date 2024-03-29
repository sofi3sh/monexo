<?php

return [
    /*
     * Название параметра в запросе с реферальным кодом.
     */
    'referralParamName' => 'ref',

    /*
     * Длина кода реферальной ссылки
     */
    'referralLength' => 21,

    /*
     * Название ключа cookie в котором будет сохранена реф. ссылка.
     */
    'referralCookieKey' => 'ref',

    'fields' => [
        /*
         * Поле в котором хранится реферальный код пользователя.
         */
        'referralCode'     => [
            'name'    => 'ref_code',
            'after'   => 'email',
            'comment' => 'Реферальная ссылка пользователя',
        ],

        /*
         * Поле в котором хранится id пользователя по реферальной ссылке которого был зарегистрирован пользователь.
         */
        'referredByUserId' => [
            'name'    => 'referred_by_user_id',
            'after'   => 'email',
            'comment' => 'id пользователя, по реферальной ссылке которого пришел пользователь',

        ],
    ],

];
