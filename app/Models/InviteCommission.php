<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InviteCommission extends Model
{
    protected $table = 'invite_commission';

    protected $fillable = ['commission'];

    /**
     * Id единственной строки.
     *
     * @return int|null
     */
    public static function getId() : ?int
    {
        $id = null;
        $inviteCommission = self::on()->get();
        if ( $inviteCommission->count() === 1 ) {
            $id = (int) $inviteCommission->pluck('id')[0];
        }

        return $id;
    }

    /**
     * Комиссия единственной строки.
     *
     * @return float|null
     */
    public static function getCommissions() : ?float
    {
        $commission = null;
        $inviteCommission = self::on()->get();
        if ( $inviteCommission->count() === 1 ) {
            $commission = (float) $inviteCommission->pluck('commission')[0];
        }

        return $commission;
    }
}
