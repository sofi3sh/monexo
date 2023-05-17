<?php

namespace App\Models\Home\Ticket;

use Illuminate\Database\Eloquent\Model;

class ResponseTemplate extends Model
{
    protected $table = 'response_template';

    protected $fillable = [
        'user_id',
        'template',
    ];
}
