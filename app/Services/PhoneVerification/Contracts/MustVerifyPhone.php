<?php


namespace App\Services\PhoneVerification\Contracts;

interface MustVerifyPhone
{
    /**
     * Determine if the user has verified their phone number.
     *
     * @return bool
     */
    public function hasVerifiedPhone(): bool;

    /**
     * Determine if the user's phone verification is still actual.
     *
     * @return bool
     */
    public function hasActualVerification(): bool;

    /**
     * Mark the given user's phone as verified.
     *
     * @param bool $remember
     * @param string $code
     * @return bool
     */
    public function markPhoneAsVerified(bool $remember, string $code): bool;
}
