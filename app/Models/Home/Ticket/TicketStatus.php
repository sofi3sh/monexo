<?php

namespace App\Models\Home\Ticket;

use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    const FRESH = 1;
    const ACTIVE = 2;
    const CLOSE = 3;

    protected $table = 'ticket_status';

    protected $fillable = [
        'descr',
    ];
}
