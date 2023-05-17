<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Services extends Model
{
    use SoftDeletes;

    protected $table = 'services';

    protected $fillable = [
        'name_en',
        'name_ru',
        'name_english',
        'price_usd',
        'services_category_id',
        'is_active',
    ];

    public function servicesCategory(): BelongsTo
    {
        return $this->BelongsTo(ServicesCategory::Class, 'services_category_id', 'id');
    }
}
