<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Языковые ресурсы для сообщений валидации
    |--------------------------------------------------------------------------
    |
    */
    'help'                 => 'Help',
    'auth'                 => [
        'base_error'         => 'Enter the correct data',
    ],
    'withdrawal'             => [
        'pack_to_balance_success' => 'Funds were successfully withdrawn from the package to the main balance.'
    ],
    'marketing_plan'       => [
        'buy_plan'           => 'Congratulations, you have purchased the package :package!',
        'error'              => 'Error investing in a marketing plan. Contact those. support.',
        'plan_close'         => 'Plan successfully closed.',
    ],
    'email_reset'          => [
        'email_success'      => 'Check your inbox :email.',
        'email_error'        => 'Error sending email. Maybe check the email address is correct.',
        'email_update'       => 'Your mail has been updated successfully. Log in to your account.',
        'email_not_update'   => 'Invalid Token',
        'email_completed'    => 'Email address successfully changed!',
    ],
    'email_reset_request'  => [
        'email_required'      => 'Enter your email.',
        'email_unique'        => 'This email is already in use.',
        'email_same'          => 'The addresses you entered do not match.',
        'email_email'         => 'Invalid email address.',
    ],
    'email_reset_mail'     => [
        'email_required'      => 'Reset email.',
    ],
    'invest_to_marketing'  => [
        'wrong_sum'           => 'The invested amount for the selected plan must be greater than or equal to $:min.',
        'wrong_sum_max'       => 'The invested amount for the selected plan exceeds the maximum equal to $:max.',
        'wrong_sum_min'       => 'The invested amount for the selected plan must be greater than or equal to $:min.',
        'wrong_sum_balance'   => 'The amount invested exceeds the balance available for investment and amounts to $:balance.',
        'has_active_plan'     => 'You already have an active marketing plan.',
    ],
];
