<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingDetailStatus extends Model
{
    use SoftDeletes;

    protected $table = 'booking_detail_status';

    protected $fillable = [
        'descr_en',
        'descr_ru',
    ];
}
