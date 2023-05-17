<?php

namespace App\Models\Home;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReferralDeposit extends Model
{
    protected $table = 'referral_deposit';

    protected $fillable = [
        'user_id',
        'amount_usd',
        'commission_percent',
        'currency',
        'marketing_plan_id',
        'marketing_plan_descr',
        // 0 - не зачисленно рефераллу, 1 - зачислено
        'is_accrued',
        // 0 - инвайт не был отменен, 1 - его отменил крон
        'reset_invite_is',
        'referral_email',
    ];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::Class, 'user_id', 'id');
    }

    public function marketingPlan(): BelongsTo
    {
        return $this->BelongsTo(MarketingPlan::Class, 'marketing_plan_id', 'id');
    }
}
