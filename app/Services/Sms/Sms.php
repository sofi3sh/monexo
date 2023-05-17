<?php


namespace App\Services\Sms;


class Sms
{
    /**
     * @var string Номер получателя
     */
    public string $recipient;

    /**
     * @var string Текст сообщения
     */
    public string $text;

    public function __construct(string $recipient, string $text)
    {
        $this->recipient = $recipient;
        $this->text = $text;
    }
}
