<?php

namespace Modules\Blog\Models\Traits;

use Modules\Blog\Services\BlogService;
use Modules\Blog\Exceptions\IncompatibleEntityModelException;

trait HasSlug
{
    /**
     * @inheritDoc
     * @throws IncompatibleEntityModelException
     */
    protected static function boot()
    {
        parent::boot();

        self::saving(function ($model) {
            $model->slug = BlogService::makeSlugForEntity($model);

            self::bootSaving($model);
        });
    }

    /** @inheritDoc */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Сохранение модели
     *
     * @param $model
     */
    protected static function bootSaving($model): void
    {
        // Манипуляция с моделью
    }
}
