<?php

namespace App\Console\Commands;

use App\Models\Home\Transaction;
use App\Mail\SocialNetworksMail;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;

/**
 * Class SendSocialNetworks
 *
 * @example php artisan mail:send-social-networks {action=[send]|show} {--status=[new]|sent|error} {--chunk=[10]} {--sleep=[10]}
 * @package App\Console\Commands
 */
class SendSocialNetworks extends Command
{
    const TEMP_TABLE = 'temp_social_network_recipients';

    const ACTION_SEND = 'send';
    const ACTION_SHOW = 'show';

    const STATUS_NEW = 'new';
    const STATUS_SENT = 'sent';
    const STATUS_ERROR = 'error';

    const STATUS_VALUES = [
        self::STATUS_NEW => 0,
        self::STATUS_SENT => 1,
        self::STATUS_ERROR => -1,
    ];

    const AVAILABLE_ACTIONS = [self::ACTION_SEND, self::ACTION_SHOW];
    const AVAILABLE_STATUSES = [self::STATUS_NEW, self::STATUS_SENT, self::STATUS_ERROR];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send-social-networks {action=send} {--status=new} {--chunk=10} {--sleep=10}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send social networks to users';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (!in_array($this->argument('action'), self::AVAILABLE_ACTIONS, true)) {
            $this->error('Available actions: ' . implode(', ', self::AVAILABLE_ACTIONS));

            return;
        }

        if (!in_array($this->option('status'), self::AVAILABLE_STATUSES, true)) {
            $this->error('Available statuses: ' . implode(', ', self::AVAILABLE_STATUSES));

            return;
        }

        if (!is_numeric($this->option('sleep'))) {
            $this->error('Sleep option must be a number: ' . implode(', ', self::AVAILABLE_STATUSES));

            return;
        }

        if (!is_numeric($this->option('chunk'))) {
            $this->error('Chunk option must be a number: ' . implode(', ', self::AVAILABLE_STATUSES));

            return;
        }

        $message = "Action: {$this->argument('action')},";
        $message .= " status: {$this->option('status')}";

        if ($this->argument('action') === 'send') {
            $message .= ", sleep: {$this->option('sleep')}";
            $message .= ", chunk: {$this->option('chunk')}";
        }

        $this->alert($message);

        switch ($this->argument('action')) {
            case self::ACTION_SEND:
                $this->send();
                break;
            case self::ACTION_SHOW:
                $this->show();
                break;
            default:
                throw new \InvalidArgumentException('Invalid argument');
        }
    }

    /**
     * Send emails.
     */
    private function send(): void
    {
        if (!$this->confirm('Start sending emails?', 'yes')) {
            return;
        }

        $this->chunkRecipients(function ($recipients) {
            foreach ($recipients as &$recipient) {
                try {
                    Mail::to($recipient)
                        ->send(new SocialNetworksMail($recipient));
                } catch (\Throwable $exception) {
                    \DB::table(self::TEMP_TABLE)
                        ->where('recipient_id', $recipient->id)
                        ->update(['sent' => self::STATUS_VALUES[self::STATUS_ERROR]]);

                    $this->error($exception->getMessage());

                    return;
                }

                \DB::table(self::TEMP_TABLE)
                    ->where('recipient_id', $recipient->id)
                    ->update(['sent' => self::STATUS_VALUES[self::STATUS_SENT]]);

                $this->info("Письмо отправлено - {$recipient->email} (id: {$recipient->id})");

                unset($recipient);
            }

            $this->line("Sleep {$this->option('sleep')} seconds");

            sleep($this->option('sleep'));
        });
    }

    /**
     * Show recipients.
     */
    private function show(): void
    {
        $allRecipients = [];

        $this->chunkRecipients(function ($recipients) use (&$allRecipients) {
            foreach ($recipients as &$recipient) {
                $allRecipients[] = "{$recipient->email} (id: {$recipient->id})";

                unset($recipient);
            }
        });

        $this->line(implode("\n", $allRecipients));
    }

    /**
     * Chunk recipients.
     *
     * @param callable $callback
     * @return bool
     */
    private function chunkRecipients(callable $callback)
    {
        /* Создание временной таблицы */

        if (!\Schema::hasTable(self::TEMP_TABLE)) {
            \Schema::create(self::TEMP_TABLE, function (Blueprint $table) {
                $table->bigInteger('recipient_id');
                $table->tinyInteger('sent');
            });
        }

        /* Заполнение временной таблицы получателями */

        if (!\DB::table(self::TEMP_TABLE)->count()) {
            $recipients = Transaction::query()
                ->select([
                    'transactions.user_id as recipient_id',
                    \DB::raw('0 as sent'),
                ])
                ->distinct()
                ->get()
                ->toArray();

            foreach (array_chunk($recipients, 500) as &$batch) {
                \DB::table(self::TEMP_TABLE)
                    ->insert($batch);

                unset($batch);
            }
        }

        $tempTableName = self::TEMP_TABLE;

        /* Перебор получателей */

        $status = self::STATUS_VALUES[$this->option('status')];

        return \DB::table($tempTableName)
            ->leftJoin('users', 'users.id', '=', "{$tempTableName}.recipient_id")
            ->where("{$tempTableName}.sent", $status)
            ->whereNotNull('users.email')
            ->orderBy("{$tempTableName}.recipient_id")
            ->select([
                "{$tempTableName}.recipient_id as id",
                "{$tempTableName}.sent",
                'users.name',
                'users.email',
                'users.locale',
            ])
            ->chunk($this->option('chunk'), $callback);
    }
}
