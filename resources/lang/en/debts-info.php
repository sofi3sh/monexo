<?php

    return [
        'page-title' => 'Information about changes in Dinway',
        'modal-title' => 'Information about changes in Dinway',
        'helpers' => [
            'body_on' => [
                'on' => 'enabled',
                'off' => 'not enabled',
            ],
            'accrual' => [
                'week' => 'weekly',
                'day' => 'daily'
            ]
        ],
        'user' => 'Dear :name!',
        'pre-info' => '<p>We would like to inform you that our company has completed the financial audit work and we apologize for the fact that it took a little longer than we initially expected.</p>
        <p>So, at the time of April 6, 2021, 00:00, your account had the following data:</p>',
        'package-info' => '
            Package opened :name, the conditions of which are:
            <br>
            Body in payouts: :body_on
            <br>
            Accruals: :accrual
            <br>
            Bet:
        ',
        'percent-min-max' => ' floating, from :min% to :max%',
        'balance' => 'Your balance was: :balance',
        'for-calc' => ' To calculate the payout amount, your packages were recalculated as follows:',
        'package-logic' => ' For package :name, the conversion logic is as follows:',
        'package-dayli-percent' => 'The number of remaining charges equal to :balanceOfCharges * the percentage of charges equal to :daily_percent * the invested amount in dollars, that is :invest',
        'invest-sum' => '+ invested amount, i.e. :invest',
        'package-total' => 'Total :$:total',
        'middle-percent' => 'The number of remaining charges equal to :balanceOfCharges * for the average percentage of charges equal to :min_profit + :max_profit / 2',
        'packages-total' => 'Total from packages :total',
        'debts-usd-info' => 'Thus, your balance for payment on the Dinway wallet was $ :debt_usd_fixed. This data is displayed in the upper panel, next to the current balance.',
        'statistics' => [
            'title' => 'In addition, here are the statistics of deposits / payments for your account:',
            'replenishment' => [
                'title' => 'Deposits of money:',
                'package-info' => 'Date: :date Input amount: :sum'
            ],
            'withdrawal' => [
                'title' => 'Money withdrawals:',
                'package-info' => 'Date: :date Input amount: :sum'
            ],
        ],
        'more-info' => ' We also inform you that in order to perform the verification procedure, you need to answer the questions posted in
        section <a href=":href " >profile settings</a>
        If you have already passed the verification procedure, the questionnaire will not be visible.'

    ];