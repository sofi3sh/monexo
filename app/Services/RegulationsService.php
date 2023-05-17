<?php

namespace App\Services;

use App\Models\CustomTransaction;
use App\Models\InviteCommission;
use App\Models\WithdrawalLimit;
use App\Models\WithdrawCommissionSettings;

class RegulationsService
{
    const LANG = 'base.dash.regulations';

    private static function getUserTransferCommission() 
    {
        return CustomTransaction::pluck('commission')[0];
    }

    private static function getInviteCommission()
    {
        return InviteCommission::getCommissions();
    }

    private static function getWithdrawalCommissions()
    {
       return WithdrawCommissionSettings::getCommissions();
    }

    private static function getWithdrawalCommissionsSection() {
        
        $commissions = self::getWithdrawalCommissions();
        $path = self::LANG . '.withdrawal-commission';

        return [
            'title' => trans("$path.title"),
            'items' => [
                trans("$path.often.more", ['days' => 7,  'sum' => $commissions['7']]) . ';',
                trans("$path.often.more", ['days' => 14, 'sum' => $commissions['14']]) . ';',
                trans("$path.often.more", ['days' => 30, 'sum' => $commissions['30']]) . ';',
                trans("$path.often.less", ['days' => 30, 'sum' => $commissions['0']]) . '.',
            ],
        ];
    }

    private static function getReglamentsSection()
    {
        $userTransferCommission = self::getUserTransferCommission();
        $inviteCommission = self::getInviteCommission();
        $path = self::LANG . '.main';

        return [
            'title' => trans("$path.title"),
            'items' => [
                trans("$path.pay-investments", ['sum' => 0]) . ';',
                trans("$path.transfer", ['sum' => $userTransferCommission]) . ';',
                trans("$path.add-invest", ['sum' => $inviteCommission]) . '.',
            ]
        ];
    }

    private static function getAddCommissionInfoSection()
    {
        $path = self::LANG . '.commissions-add';
        $cardLimit = WithdrawalLimit::select('value')
                                    ->where('name', 'card')
                                    ->first()
                                    ->value;

        return [
            'title' => trans("$path.title"),
            'items' => [
                trans("$path.card", ['limit' => $cardLimit]) . ';',
                trans("$path.perfect") . '.',
            ],
            'add-info' => trans("$path.add-info"),
        ];
    }

    public static function getSections()
    {
        return [
            self::getReglamentsSection(),
            self::getWithdrawalCommissionsSection(),
            self::getAddCommissionInfoSection()
        ];
    }
}