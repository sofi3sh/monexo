<?php

namespace App\Models\Home\Ticket;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TicketFront extends Model
{
    protected $table = 'ticket_front';

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'question',
        'answer',
    ];
}
