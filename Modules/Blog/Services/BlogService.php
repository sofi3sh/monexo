<?php

namespace Modules\Blog\Services;

use Illuminate\Support\Str;
use Modules\Blog\Models\{Post, Category, Tag};
use Modules\Blog\Exceptions\IncompatibleEntityModelException;

class BlogService
{
    /**
     * Make slug for entity (Post|Category|Tag)
     *
     * @param $model
     * @return string
     * @throws IncompatibleEntityModelException
     */
    public static function makeSlugForEntity($model): string
    {
        if (!$model instanceof Post
            && !$model instanceof Category
            && !$model instanceof Tag) {
            throw new IncompatibleEntityModelException;
        }

        $modelClass = get_class($model);

        $slug = Str::slug($model->slug ?: $model->name);

        $similarSlugs = $modelClass::query()
            ->select('slug')
            ->where('slug', 'like', "%$slug%")
            ->where('id', '!=', $model->id)
            ->get();

        while (true) {
            if (!$similarSlugs->contains('slug', $slug)) {
                return $slug;
            }

            $slug .= '--' . Str::random(4);
        }
    }
}
