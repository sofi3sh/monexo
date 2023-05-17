<?php

return [
    'letter' => [
        'invite-referral-email_required' => 'The email address must be filled in.',
        'invite-referral-email_email' => 'Invalid email format.',
        'invite-referral-email_unique' => 'User with this e-mail is already registered',
//        'package_required' => 'Package name is required.',
//        'package_in' => 'The package name must match the list (Standart, Mini, Light).',
//        'deposit-amount_required' => 'The deposit amount must be filled.',
//        'deposit-amount_numeric' => 'The deposit amount is not numeric.',
//        'deposit-amount_digits_between' => 'The deposit amount is not within the acceptable range.',
//        'deposit-amount_max' => 'Сумма депозита превышает максимум.',
    ],
    'message_success' => [
        'success' => 'Invitation sent successfully! ',
        'email' => 'Email: ',
        'package' => 'Package: ',
        'deposit_amount' => 'Deposit amount: ',
    ],
    'message_error' => [
        'marketing_plan_not_fount' => 'The package in the database directories was not found.',
        'no_cash' => 'Not enough money in the account.',
        'already_sent_email' => 'You have already sent a letter to this email.',
        'already_registered' => 'User with this email is already registered.',
    ],
];
