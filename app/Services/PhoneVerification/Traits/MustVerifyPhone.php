<?php


namespace App\Services\PhoneVerification\Traits;


use App\Models\Home\PhoneVerificationCode;
use App\Services\PhoneVerification\PhoneVerification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait MustVerifyPhone
{
    /**
     * Determine if the user has verified their phone number.
     *
     * @return bool
     */
    public function hasVerifiedPhone(): bool
    {
        return ! is_null($this->phone_verified_at);
    }

    public function hasActualVerification(): bool
    {
        return $this->phone_verified_to > Carbon::now();
    }

    /**
     * Mark the given user's phone as verified.
     *
     * @param bool $remember
     * @param string $code
     * @return bool
     */
    public function markPhoneAsVerified(bool $remember, string $code): bool
    {
        $rememberDays = config('auth.phone_verification_code.remember_days') ?
            config('auth.phone_verification_code.remember_days') :
            14;

        if ($this->checkIsActualCode($code)) {
            $result = $this->forceFill([
                'phone_verified_at' => $this->freshTimestamp(),
                'phone_verified_to' => $remember ?
                    Carbon::now()->addDays($rememberDays)->toDateTime() :
                    $this->freshTimestamp(),
            ])->save();

            if ($result) {
                $this->markUserCodesAsUsed();
                return true;
            }
        }

        return false;
    }

    /**
     * Change user's phone
     *
     * @param string $code
     * @param string $phone
     * @return bool
     */
    public function changePhone(string $code, string $phone): bool
    {
        if ($this->checkIsActualCode($code, $phone)) {
            $result = $this->forceFill([
                'phone_verified_at' => $this->freshTimestamp(),
                'phone_verified_to' => null,
                'phone' => $phone
            ])->save();

            if ($result) {
                $this->markUserCodesAsUsed();
                return true;
            }
        }

        return false;
    }

    /**
     * Mark the given user's phone as NOT verified.
     *
     * @return bool
     */
    public function markPhoneAsNotVerified(): bool
    {
        return $this->forceFill([
            'phone_verified_at' => null,
            'phone_verified_to' => null
        ])->save();
    }

    /**
     * @param bool $force
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendPhoneVerificationSms(bool $force = false): bool
    {
        if (!$force)
        {
            $actualCodes = $this->hasActualCodes();

            if ($actualCodes) {
                return FALSE;
            }
        } else {
            $this->markUserCodesAsUsed();
        }

        return (new PhoneVerification())->sendVerificationCode(auth()->user());
    }

    public function phoneVerificationCodes(): HasMany
    {
        return $this->hasMany(PhoneVerificationCode::class, 'user_id','id');
    }

    /**
     * Проверка наличия актуальных кодов верификации
     *
     * @return bool
     */
    private function hasActualCodes(): bool
    {
        return PhoneVerificationCode::where([
            ['user_id', auth()->user()->id],
            ['expiration', '>', Carbon::now()],
            ['is_used', false]
        ])->exists();
    }

    /**
     * Проверка актуальности кода верификации
     *
     * @param $code
     * @param null $phone
     * @return bool
     */
    private function checkIsActualCode($code, $phone = null): bool
    {
        return PhoneVerificationCode::where([
            ['user_id', auth()->user()->id],
            ['code', $code],
            ['expiration', '>', Carbon::now()],
            ['is_used', false],
            ['phone', $phone ? $phone : auth()->user()->phone],
        ])->exists();
    }

    /**
     * Пометить код(ы) пользователя как "использованный(е)"
     */
    private function markUserCodesAsUsed()
    {
        PhoneVerificationCode::where([
            ['user_id', auth()->user()->id]
        ])->update(['is_used' => true]);
    }
}
