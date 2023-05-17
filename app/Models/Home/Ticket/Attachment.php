<?php

namespace App\Models\Home\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attachment extends Model
{
    protected $table = 'attachment';

    protected $fillable = [
        'ticket_id',
        'path',
    ];

    public function ticket(): BelongsTo
    {
        return $this->BelongsTo(Ticket::Class, 'ticket_id', 'id')
            ->withDefault();
    }
}
