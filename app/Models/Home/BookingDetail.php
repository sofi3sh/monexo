<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Home\Booking;
use App\Models\Home\Services;
use App\Models\Home\BookingDetailStatus;

class BookingDetail extends Model
{
    use SoftDeletes;

    protected $table = 'booking_detail';

    protected $fillable = [
        'booking_id',
        'services_id',
        'amount_usd',
        'status_id',
    ];

    public function booking(): BelongsTo
    {
        return $this->BelongsTo(Booking::Class, 'booking_id', 'id');
    }

    public function services(): BelongsTo
    {
        return $this->BelongsTo(Services::Class, 'services_id', 'id');
    }

    public function status(): BelongsTo
    {
        return $this->BelongsTo(BookingDetailStatus::Class, 'status_id', 'id');
    }
}
