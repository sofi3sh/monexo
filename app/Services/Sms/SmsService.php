<?php


namespace App\Services\Sms;

use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Log;

class SmsService
{
    const SENDER_NAME = 'DINWAY';

    private Sms $sms;
    private GuzzleClient $httpClient;

    public function __construct()
    {
        $this->httpClient = new GuzzleClient(['base_uri' => 'https://api.turbosms.ua']);
    }

    /**
     * Новый экземпляр сообщения
     *
     * @param string $recipient
     * @param string $text
     * @return $this
     */
    public function sms(string $recipient, string $text): SmsService
    {
        $this->sms = new Sms($recipient, $text);

        return $this;
    }

    /**
     * Отправка смс
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @return bool
     */
    public function send(): bool
    {
        $response = $this->httpClient->request('POST', '/message/send.json', [
            'json' => $this->buildSms($this->sms),
            'headers' => [
                'Authorization' => 'Bearer ' . env('TURBO_SMS_API_TOKEN'),
                'Content-Type' => 'application/json'
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        if (($response['response_code'] == 0 and $response['response_status'] == "OK") or
            ($response['response_code'] == 801 and $response['response_status'] == "SUCCESS_MESSAGE_SENT")) {
            Log::channel('sms_log')
                ->info('Смс отправлено ' . $this->sms->recipient. ': ' . $this->sms->text);

            return true;
        } else {
            Log::channel('sms_log')
                ->info('Смс НЕ отправлено ' . $this->sms->recipient. ': code: ' .
                    $response['response_code'] . ' status ' . $response['response_status']);

            return false;
        }
    }

    /**
     * Преобразование смс в нужный формат
     *
     * @param Sms $sms
     * @return array
     */
    private function buildSms(Sms $sms): array
    {
        $smsText = $sms->text;

        if (env('APP_ENV') !== 'production') {
            $smsText .= ' (' . env('APP_ENV') . ')';
        }

        return [
            'recipients' => [
                (string) $sms->recipient
            ],
            'sms' => [
                'sender' => self::SENDER_NAME,
                'text' => $smsText
            ]
        ];
    }
}
