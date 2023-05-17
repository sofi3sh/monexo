<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    protected $table = 'exchangen';

    protected $fillable = [
        'balance_from',
        'amount_from',
        'balance_to',
        'amount_to',
        'rate',
        'user_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
