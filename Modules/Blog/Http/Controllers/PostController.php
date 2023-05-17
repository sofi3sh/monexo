<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Blog\Models\{Post, Category};
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    /**
     * Страница с постами
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $isLk = explode('/', $request->getPathInfo())[1] == 'home';
        
        $requestData = $request->validate([
            'category' => 'bail|nullable|string|exists:blog_categories,slug',
        ]);

        $categories = Category::select('id', 'slug', 'name')->get();

        $selectedCategory = isset($requestData['category'])
            ? $categories->where('slug', $requestData['category'])->first()
            : null;

        $paginator = Post::published()
            ->with([
                'author:id,name',
                'category:id,name,slug,color',
                'tags:name,slug',
                'meta:post_id,description,keywords',
            ])
            ->when($selectedCategory, function ($query, $category) {
                $query->where('category_id', $category->id);
            })
            ->latest('published_at')
            ->select([
                'id',
                'category_id',
                'author_id',
                'name',
                'slug',
                'excerpt',
                'image',
                'views',
                'published_at',
            ])
            ->simplePaginate(10);

        $hasMorePosts = $paginator->hasMorePages();

        $posts = $paginator->items();
        
        if($isLk) {
            return view('dashboard.blog.blog-list', compact(
                'posts',
                'categories',
                'selectedCategory',
                'hasMorePosts'
            ));
        }
        else {
            return view('dinway.blog.blog-list', [
                'posts' => $posts,
                'categories' => $categories,
                'selectedCategory' => $selectedCategory,
                'hasMorePosts' => $hasMorePosts,
            ]);
        }
    }

    /**
     * Страница с постом
     *
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|View
     */
    public function show(Post $post, Request $request)
    {
        $isLk = explode('/', $request->getPathInfo())[1] == 'home';
        
        if (!$post->isPublished()) {
            return redirect()->route('blog.post.index');
        }

        $post->increment('views');
        if($isLk) {
            return view('dashboard.blog.blog-item', compact('post'));
        }
        else {
            return view('dinway.blog.blog-item', compact('post'));
        }
    }

    /**
     * Получить самые популярные посты
     *
     * @param int $limit
     * @return array
     */
    private function getMostPopularPosts(int $limit = 10): array
    {
        return Cache::remember('blog:most_popular_posts', now()->addHour(), function () use ($limit) {
            return Post::published()
                ->latest('views')
                ->limit(10)
                ->select([
                    'name',
                    'slug',
                    'excerpt',
                    'image',
                    'views',
                ])
                ->get()
                ->toArray();
        });
    }
}
