<?php


namespace App\Services\TelegramVerification\Traits;


use App\Models\Home\PhoneVerificationCode;
use App\Services\PhoneVerification\PhoneVerification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait MustVerifyTelegram
{
    /**
     * Determine if the user has authorized to telegram.
     *
     * @return bool
     */
    public function hasVerifiedTelegram(): bool
    {
        return ($this->telegram_verification_status && ! $this->telegram_verification_required);
    }

    public function markTelegramAsNotVerified()
    {
        $this->update(['telegram_verification_status' => false]);
    }
}
