<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    /** @var int Status ID */
    const STATUS_REGIONAL_REPRESENTATIVE = 1;

    /** @inheritDoc  */
    protected $table = 'user_statuses';

    /** @inheritDoc  */
    protected $fillable = ['name', 'description'];
}
