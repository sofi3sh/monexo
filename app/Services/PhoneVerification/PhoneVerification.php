<?php


namespace App\Services\PhoneVerification;


use App\Models\Home\PhoneVerificationCode;
use App\Models\User;
use App\Services\Sms\SmsService;
use Carbon\Carbon;

class PhoneVerification
{
    const VERIFICATION_CODE_LENGTH = 4;
    const VERIFICATION_CODE_LIFETIME_SECONDS = 300;

    private SmsService $smsService;
    private User $user;
    private string $newPhone;

    public function __construct()
    {
        $this->smsService = new SmsService;
    }

    /**
     * Отправка нового кода подтверждения
     *
     * @param User $user
     * @param string|null $newPhone
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendVerificationCode(User $user, string $newPhone = null): bool
    {
        $this->user = $user;

        if ($newPhone) {
            $this->newPhone = $newPhone;
        }

        if (!$this->checkInterval()) {
            return false;
        }

        $code = $this->createVerificationCode();

        return $this->smsService->sms($this->getPhone(), $code)->send();
    }

    /**
     * Создать новый код
     *
     * @param User $user
     * @return string
     */
    private function createVerificationCode(): string
    {
        $newVerificationCode = $this->user->phoneVerificationCodes()->create([
            'code' => $this->generateVerificationCode(),
            'expiration' => $this->calculateVerificationCodeExpiration(),
            'phone' => $this->getPhone()
        ]);

        return $newVerificationCode->code;
    }

    /**
     * Генерирует код подтверждения с учетом установленной длины
     *
     * @param int $length
     * @return string
     */
    private function generateVerificationCode(int $length = self::VERIFICATION_CODE_LENGTH): string
    {
        config('auth.phone_verification_code.length') ??
        $length = config('auth.phone_verification_code.length');

        $code = '';

        for($i = 0; $i < $length; $i++) {
            $code .= mt_rand(0, 9);
        }

        return $code;
    }

    /**
     * Рассчитывает время истечения актуальности кода подтверждения
     *
     * @param int $lifetimeSeconds
     * @return \DateTime
     */
    private function calculateVerificationCodeExpiration(int $lifetimeSeconds = self::VERIFICATION_CODE_LIFETIME_SECONDS): \DateTime
    {
        config('auth.phone_verification_code.lifetime') ??
            $lifetimeSeconds = config('auth.phone_verification_code.lifetime');

        return Carbon::now()->addSeconds($lifetimeSeconds)->toDateTime();
    }

    private function getPhone(): ?string
    {
        return empty($this->newPhone) ? $this->user->phone : $this->newPhone;
    }

    private function checkInterval(): bool
    {
        $interval = config('auth.phone_verification_code.interval');

        return PhoneVerificationCode::where([
            ['user_id', $this->user->id],
            ['created_at', '>', Carbon::now()->subSeconds($interval)],
        ])->doesntExist();
    }
}
