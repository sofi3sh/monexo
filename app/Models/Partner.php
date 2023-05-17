<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    /** @inheritDoc */
    protected $table = 'partners';

    /** @inheritDoc */
    protected $fillable = [
        'name',
        'surname',
        'city',
        'phone',
        'coordinates',
        'telegram',
        'date_birthday',
    ];

    /** @inheritDoc */
    protected $casts = [
        'coordinates' => 'array',
    ];

    /**
     * Атрибут Возраст
     *
     * @return mixed
     */
    public function getAgeAttribute()
    {
        return now()->diffInYears($this->attributes['date_birthday']);
    }
}
