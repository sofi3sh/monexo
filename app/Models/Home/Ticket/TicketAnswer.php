<?php

namespace App\Models\Home\Ticket;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketAnswer extends Model
{
    protected $table = 'ticket_answer';

    protected $fillable = [
        'ticket_id',
        'answer',
        'user_id',
        'viewed'
    ];

    protected $appends = [
        'humans_time'
    ];

    public function ticket(): BelongsTo
    {
        return $this->BelongsTo(Ticket::Class, 'ticket_id', 'id')
            ->withDefault();
    }

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::Class, 'user_id', 'id')
            ->withDefault();
    }

    public function getHumansTimeAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->diffForHumans();
    }
}
