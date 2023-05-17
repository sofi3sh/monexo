<?php


namespace App\Repositories\Suggestion;


use App\Models\Suggestion;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Auth;

class SuggestionRepository extends Repository implements SuggestionRepositoryInterface
{
    /**
     * @var Suggestion
     */
    protected $model;

    /**
     * UserIpRepository constructor.
     *
     * @param Suggestion $model
     */
    public function __construct(Suggestion $model)
    {
        parent::__construct($model);
    }

    /**
     * Список целей для пользователя
     *
     * @param int|null $typeIdFilter
     * @return mixed
     */
    public function getForUser(int $typeIdFilter = null)
    {
        $user = Auth::user();

        return Suggestion::where('is_moderated', 1)
            ->withCount(['likes as likes_count' => function ($query) {
                $query->where('is_positive', true);
            }])
            ->withCount(['likes as dislikes_count' => function ($query) {
                $query->where('is_positive', false);
            }])
            ->with(['likes' => function ($query) use ($user) {
                $query->where([
                    ['user_id', $user->id],
                ]);
            }])
            ->when(!is_null($typeIdFilter), function ($query) use ($typeIdFilter) {
                if ($typeIdFilter != '0') {
                    $query->where('type_id', $typeIdFilter);
                } else {
                    $query->whereNull('type_id');
                }
            })
            ->when(is_null($typeIdFilter), function ($query) {
                $query->with('type');
            })
            ->orderBy('likes_count', 'desc')
            ->orderBy('dislikes_count', 'asc')
            ->paginate(25);
    }

    /**
     * Добавить лайк
     *
     * @param int $id
     */
    public function like(int $id)
    {
        $item = $this->model->find($id);
        $item->likedUsers()->detach(Auth::user()->id);
        $item->likedUsers()->attach(Auth::user()->id, ['is_positive' => true]);
    }

    /**
     * Добавить лайк
     *
     * @param int $id
     */
    public function dislike(int $id)
    {
        $item = $this->model->find($id);
        $item->likedUsers()->detach(Auth::user()->id);
        $item->likedUsers()->attach(Auth::user()->id, ['is_positive' => false]);
    }

    /**
     * Убрать лайк
     *
     * @param int $id
     */
    public function unlike(int $id)
    {
        $item = $this->model->find($id);
        $item->likedUsers()->detach(Auth::user()->id);
    }

    /**
     * Одобрить цель
     *
     * @param int $id
     */
    public function apply(int $id)
    {
        $this->model->where('id', $id)->update(['is_moderated' => true]);
    }

    /**
     * Отклонить цель
     *
     * @param int $id
     */
    public function decline(int $id)
    {
        $this->model->where('id', $id)->update(['is_moderated' => false]);
    }
}
