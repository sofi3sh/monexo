<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Home\OutgoingPayments
 *
 * @property int $id
 * @property int $user_id id пользователя
 * @property string $received_at Дата получения средств
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\OutgoingPayments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\OutgoingPayments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\OutgoingPayments query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\OutgoingPayments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\OutgoingPayments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\OutgoingPayments whereReceivedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\OutgoingPayments whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\OutgoingPayments whereUserId($value)
 * @mixin \Eloquent
 */
class OutgoingPayments extends Model
{
    //
}
