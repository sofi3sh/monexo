<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Modules\Blog\Models\Category;
use Modules\Blog\Models\Post;

/**
 * Connect Http Request class
 */
use Illuminate\Http\Request;

class NewsViewComposer
{
    private $request;

    /**
     * Pass $request
     */
    public function __construct(Request $request)
    {
       $this->request = $request;
    }

    public function compose(View $view)
    {
        $posts = Post::published()
            ->with([
                'author:id,name',
                'category:id,name,color',
            ])
            ->latest('published_at')
            ->select([
                'id',
                'category_id',
                'author_id',
                'name',
                'slug',
                'excerpt',
                'image',
                'published_at',
            ])
            ->limit(10)
            ->get();

        $view->with(compact('posts'));
    }
}
