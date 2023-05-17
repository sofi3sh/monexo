<?php

namespace Dok5\Referrals;

use Illuminate\Support\Facades\Cookie;
use App\Models\User;
use Illuminate\Support\Str;

trait Referral
{
    /*
    |--------------------------------------------------------------------------
    | Referral Trait
    |--------------------------------------------------------------------------
    |
    */


    /**
     *
     *
     * @return mixed
     */
    public function getGeneratedReferralCode()
    {
        //todo длину задавать через config-файл
        //todo Надо делать проверку на уникальность
        return Str::random(12);
    }

    /**
     *
     * @return array|null|string
     */
    public function getReferralCode()
    {
        return Cookie::get(config('referrals.referralCookieKey'));
    }

    /**
     * Возвращает пользователя по реферальной ссылке которого пришел текущий пользователь
     *
     */
    public function getReferralUser()
    {
        $refCode = $this->getReferralCode();
        if (!is_null($refCode)) {
            $user = User::where(config('referrals.fields.referralCode.name'), $refCode)->first();
        } else $user = null;

        return $user;
    }

    /**
     * Возвращает id пользователя по реферальной ссылке которого был осуществлен переход (код которого хранится в куках)
     *
     * @return null|int
     *
     */
    public function getReferralUserId()
    {
        return is_null($this->getReferralUser()) ? null : $this->getReferralUser()->id;
    }

}