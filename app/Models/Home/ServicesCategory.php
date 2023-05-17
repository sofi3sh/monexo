<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServicesCategory extends Model
{
    use SoftDeletes;

    protected $table = 'services_category';

    protected $fillable = [
        'slug',
    ];

    /**
     * @var "BlogTime id"
     */
    const BLOGTIME_ID        = 1;

    /**
     * @var "BusinessPack id"
     */
    const BUSINESSPACK_ID   = 2;

    /**
     * @var "Profi Universe id"
     */
    const PROFI_UNIVERSE_ID = 3;

    /**
     * @var "BlogTime slug"
     */
    const BLOGTIME_SLUG         = 'blogtime';

    /**
     * @var "BusinessPack slug"
     */
    const BUSINESSPACK_SLUG     = 'businesspack';

    /**
     * @var "Profi Universe slug"
     */
    const PROFI_UNIVERSE_SLUG   = 'profi_universe';
}
