<?php

namespace Modules\Blog\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\UrgentNewsMail;
use App\Models\NewsSubscribe;
use Modules\Blog\Models\{Meta, Post, Category, Tag};
use Yajra\DataTables\Facades\DataTables;
use Illuminate\View\View;
use Illuminate\Support\HtmlString;
use Illuminate\Http\{Request, RedirectResponse, JsonResponse};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    /**
     * Форма создания
     *
     * @return View
     */
    public function create(): View
    {
        $categoryOptions = Category::query()
            ->select(DB::raw("TRIM('\"' FROM JSON_EXTRACT(name, '$.ru')) as label"), 'slug as value')
            ->get();

        $tagOptions = Tag::query()
            ->select('name as label', 'slug as value')
            ->get();

        $fields = [
            [
                'name' => 'name_ru',
                'label' => 'Название на русском',
                'required' => true,
            ],
            [
                'name' => 'name_en',
                'label' => 'Название на английском',
                'required' => true,
            ],
            [
                'name' => 'slug',
                'label' => 'Уникальный семантический идентификатор',
                'type' => 'text',
                'hint' => 'Рекомендуется оставить пустым, по умолчанию будет создан автоматически из названия',
            ],
            [
                'name' => 'content_ru',
                'label' => 'Контент на русском',
                'type' => 'textarea',
                'rows' => 6,
                'required' => true,
            ],
            [
                'name' => 'content_en',
                'label' => 'Контент на английском',
                'type' => 'textarea',
                'rows' => 6,
                'required' => true,
            ],
            [
                'name' => 'meta_description',
                'label' => 'Метатег Description',
            ],
            [
                'name' => 'meta_keywords',
                'label' => 'Метатег Keywords',
            ],
            [
                'name' => 'category',
                'label' => 'Категория',
                'type' => 'select',
                'options' => $categoryOptions,
                'required' => true,
            ],
            [
                'name' => 'tags',
                'label' => 'Теги',
                'type' => 'select',
                'options' => $tagOptions,
                'multiple' => true,
                'hint' => 'Используйте Shift и Command/Ctrl для выбора нескольких тегов',
            ],
            [
                'name' => 'image',
                'label' => 'Картинка',
                'type' => 'image',
            ],
            [
                'name' => 'publish',
                'label' => 'Опубликовать',
                'type' => 'checkbox',
                'checked' => true,
                'hint' => 'Опубликовать сразу после создания',
            ],
        ];

        return view('admin.includes.partials.blog.form', [
            'title' => 'Создание поста',
            'action_route' => route('admin.blog.post.store'),
            'action_name' => 'Создать',
            'action_method' => 'post',
            'fields' => $fields,
        ]);
    }

    /**
     * Создать пост
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function store(Request $request): RedirectResponse
    {
        $requestData = $request->validate([
            'name_ru' => 'required|string|min:2|max:' . Post::MAX_NAME_LENGTH,
            'name_en' => 'required|string|min:2|max:' . Post::MAX_NAME_LENGTH,
            'slug' => 'nullable|string|min:2|max:' . Post::MAX_SLUG_LENGTH . 'unique:blog_posts,slug',
            'content_ru' => 'required|string|min:2',
            'content_en' => 'required|string|min:2',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,svg|max:2048',
            'meta_description' => 'nullable|required_with:meta_keywords|string|min:2|max:' . Meta::MAX_DESCRIPTION_LENGTH,
            'meta_keywords' => 'nullable|required_with:meta_description|string|min:2|max:' . Meta::MAX_KEYWORDS_LENGTH,
            'category' => 'required|exists:blog_categories,slug',
            'tags' => 'nullable|array|exists:blog_tags,slug',
            'publish' => 'nullable|boolean',
        ]);

        DB::transaction(function () use ($request, $requestData) {
            $categoryId = Category::query()
                ->where('slug', $requestData['category'])
                ->firstOrFail()->id;

            $post = Post::create([
                'name' => [
                    'ru' => $requestData['name_ru'],
                    'en' => $requestData['name_en'],
                ],
                'slug' => $requestData['slug'],
                'content' => [
                    'ru' => $requestData['content_ru'],
                    'en' => $requestData['content_en'],
                ],
                'category_id' => $categoryId,
                'author_id' => auth()->id(),
            ]);

            if ($file = $request->file('image')) {
                $fileExtension = $file->getClientOriginalExtension();
                $fileNameToStore = hash('sha256', 'blog-post' . $post->id) . '.' . $fileExtension;
                $filePath = $file->storeAs('public/uploads', $fileNameToStore);

                $post->image = $filePath;
            }

            if (isset($requestData['meta_description'])) {
                $post->meta()->create([
                    'post_id' => $post->id,
                    'description' => $requestData['meta_description'],
                    'keywords' => $requestData['meta_keywords'],
                ]);
            }

            if (isset($requestData['tags'])) {
                $tags = Tag::query()
                    ->whereIn('slug', $requestData['tags'])
                    ->get();

                $post->tags()->sync($tags);
            }

            if (!empty($requestData['publish'])) {
                $post->publish();
            }

            $post->save();

            if($post->category_id === Category::URGENT_NEWS_ID && $post->published_at != NULL) {

                $recipients = NewsSubscribe::all();
    
                try {
                    foreach($recipients as $index => $recipient) {
                        $locale = $recipient->user->locale ?? 'ru';
                        Mail::to($recipient->email)
                            ->locale($locale)
                            ->send(new UrgentNewsMail($recipient->email, $post));
                    }
    
                } catch (\Exception $e) {
                    return $e;
                }
            }
        });

        return redirect()->route('admin.blog.index')
            ->with('status', 'Пост успешно создан');
    }

    /**
     * Форма редактирования
     *
     * @param Post $post
     * @return View
     */
    public function edit(Post $post): View
    {
        $categoryOptions = Category::query()
            ->select(DB::raw("TRIM('\"' FROM JSON_EXTRACT(name, '$.ru')) as label"), 'slug as value')
            ->get()
            ->transform(function ($item) use ($post) {
                if ($item->value === $post->category->slug) {
                    $item->selected = true;
                }

                return $item;
            });

        $tagOptions = Tag::query()
            ->select('name as label', 'slug as value')
            ->get()
            ->transform(function ($item) use ($post) {
                if ($post->tags->where('slug', $item->value)->isNotEmpty()) {
                    $item->selected = true;
                }

                return $item;
            });

        $fields = [
            [
                'name' => 'id',
                'label' => '#',
                'value' => $post->id,
                'readonly' => true,
            ],
            [
                'name' => 'name_ru',
                'label' => 'Название на русском',
                'value' => $post->getTranslation('name', 'ru'),
                'required' => true,
            ],
            [
                'name' => 'name_en',
                'label' => 'Название на английском',
                'value' => $post->getTranslation('name', 'en'),
                'required' => true,
            ],
            [
                'name' => 'slug',
                'label' => 'Уникальный семантический идентификатор',
                'type' => 'text',
                'placeholder' => $post->slug,
                'hint' => 'Рекомендуется оставить пустым, по умолчанию будет создан автоматически из названия',
            ],
            [
                'name' => 'content_ru',
                'label' => 'Контент на русском',
                'type' => 'textarea',
                'rows' => 5,
                'value' => $post->getTranslation('content', 'ru'),
                'required' => true,
            ],
            [
                'name' => 'content_en',
                'label' => 'Контент на английском',
                'type' => 'textarea',
                'rows' => 5,
                'value' => $post->getTranslation('content', 'en'),
                'required' => true,
            ],
            [
                'name' => 'meta_description',
                'label' => 'Метатег Description',
                'value' => optional($post->meta)->description,
            ],
            [
                'name' => 'meta_keywords',
                'label' => 'Метатег Keywords',
                'value' => optional($post->meta)->keywords,
            ],
            [
                'name' => 'category',
                'label' => 'Категория',
                'type' => 'select',
                'options' => $categoryOptions,
                'required' => true,
            ],
            [
                'name' => 'tags',
                'label' => 'Теги',
                'type' => 'select',
                'options' => $tagOptions,
                'multiple' => true,
                'hint' => 'Используйте Shift и Command/Ctrl для выбора нескольких тегов',
            ],
            [
                'name' => 'image',
                'label' => 'Картинка',
                'type' => 'image',
                'value' => $post->image,
            ],
            [
                'name' => 'author',
                'label' => 'Автор',
                'value' => $post->author->name,
                'readonly' => true,
            ],
            [
                'name' => 'created_at',
                'label' => 'Создан',
                'value' => $post->created_at,
                'readonly' => true,
            ],
            [
                'name' => 'updated_at',
                'label' => 'Изменен',
                'value' => $post->updated_at,
                'readonly' => true,
            ],
            [
                'name' => 'published_at',
                'label' => 'Опубликован',
                'value' => $post->published_at,
                'readonly' => true,
            ],
            [
                'name' => 'views',
                'label' => 'Просмотры',
                'value' => $post->views,
                'readonly' => true,
            ],
            [
                'name' => 'publish',
                'label' => 'Опубликован',
                'type' => 'checkbox',
                'value' => (bool)$post->published_at,
                'hint' => 'Если этот флажок не установлен, публикация будет отменена',
            ],
        ];

        return view('admin.includes.partials.blog.form', [
            'title' => 'Редактирование поста',
            'action_route' => route('admin.blog.post.update', $post->slug),
            'action_name' => 'Сохранить',
            'action_method' => 'patch',
            'fields' => $fields,
        ]);
    }

    /**
     * Обновить пост
     *
     * @param Post $post
     * @param Request $request
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function update(Post $post, Request $request): RedirectResponse
    {
        $requestData = $request->validate([
            'name_ru' => 'required|string|min:2|max:' . Post::MAX_NAME_LENGTH,
            'name_en' => 'required|string|min:2|max:' . Post::MAX_NAME_LENGTH,
            'slug' => 'nullable|string|min:2|max:' . Post::MAX_SLUG_LENGTH . 'unique:blog_posts,slug,' . $post->slug,
            'content_ru' => 'required|string|min:2',
            'content_en' => 'required|string|min:2',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,svg|max:2048',
            'meta_description' => 'nullable|required_with:meta_keywords|string|min:2|max:' . Meta::MAX_DESCRIPTION_LENGTH,
            'meta_keywords' => 'nullable|required_with:meta_description|string|min:2|max:' . Meta::MAX_KEYWORDS_LENGTH,
            'category' => 'required|exists:blog_categories,slug',
            'tags' => 'nullable|array|exists:blog_tags,slug',
            'publish' => 'nullable|boolean',
        ]);

        DB::transaction(function () use ($post, $request, $requestData) {
            $post->update([
                'slug' =>  $requestData['slug'],
                'name' => [
                    'ru' => $requestData['name_ru'],
                    'en' => $requestData['name_en'],
                ],
                'content' => [
                    'ru' => $requestData['content_ru'],
                    'en' => $requestData['content_en'],
                ]
            ]);

            if ($file = $request->file('image')) {
                $fileExtension = $file->getClientOriginalExtension();
                $fileNameToStore = hash('sha256', 'blog-post' . $post->id) . '.' . $fileExtension;
                $filePath = $file->storeAs('public/uploads', $fileNameToStore);

                $post->image = $filePath;
            }

            if (isset($requestData['meta_description'])) {
                $post->meta()->updateOrCreate(['post_id' => $post->id], [
                    'description' => $requestData['meta_description'],
                    'keywords' => $requestData['meta_keywords'],
                ]);
            }

            if ($post->category->slug !== $requestData['category']) {
                $category = Category::query()
                    ->where('slug', $requestData['category'])
                    ->firstOrFail();

                $post->category()->associate($category);
            }

            if (empty($requestData['tags'])) {
                $post->tags()->sync([]);
            } else {
                $tags = Tag::query()
                    ->whereIn('slug', $requestData['tags'])
                    ->get();

                $post->tags()->sync($tags);
            }

            if (empty($requestData['publish'])) {
                $post->cancelPublication();
            } else if (!$post->isPublished()) {
                $post->publish();
            }

            $post->save();
        });

        return redirect()->route('admin.blog.index')
            ->with('status', 'Пост успешно обновлен');
    }

    /**
     * Удалить пост
     *
     * @param Post $post
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->back()
            ->with('status', 'Пост успешно удален');
    }

    /**
     * Получить данные для таблицы
     *
     * @return JsonResponse
     */
    public function getTableData(): JsonResponse
    {
        $query = Post::query()
            ->with([
                'author:id,name',
                'category:id,name',
                'tags:name',
                'meta:post_id,description,keywords',
            ])
            ->latest('published_at')
            ->select([
                'id',
                'category_id',
                'author_id',
                'name',
                'slug',
                'image',
                'views',
                'published_at',
                'created_at',
                'updated_at',
            ]);

        return DataTables::eloquent($query)
            ->addColumn('category', function (Post $post) {
                return $post->category->name;
            })
            ->addColumn('author', function (Post $post) {
                return $post->author->name;
            })
            ->addColumn('tags', function (Post $post) {
                return $post->tags->pluck('name')->implode(', ');
            })
            ->addColumn('meta', function (Post $post) {
                if (!$post->meta) return null;

                return 'Keywords: ' . $post->meta->keywords . PHP_EOL . 'Description: ' . $post->meta->description;
            })
            ->addColumn('actions', function (Post $post) {
                $showButtonHtml = '<a target="_blank" href="' . route('blog.post.show', $post->slug) . '" class="btn btn-sm">👁️</a>';
                $editButtonHtml = '<a href="' . route('admin.blog.post.edit', $post->slug) . '" class="btn btn-sm">✏️</a>';
                $deleteButtonHtml = '<form method="post" action="' . route('admin.blog.post.destroy', $post->slug) . '" onsubmit="return confirm(\'Удалить ' . $post->name . '?\');">'
                    . '<input type="hidden" name="_method" value="delete"/>'
                    . csrf_field()
                    . '<button type="submit" class="btn">🗑️</button>'
                    . '</form>';

                return new HtmlString("<div style='display: flex; align-items: center;'>"
                    . ($post->isPublished() ? $showButtonHtml . ' ' : '')
                    . "{$editButtonHtml} {$deleteButtonHtml}</div>");
            })
            ->toJson();
    }
}
