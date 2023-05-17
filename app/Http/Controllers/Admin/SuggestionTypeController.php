<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SuggestionTypeRequest;
use App\Models\Admin\UserIp;
use App\Repositories\SuggestionType\SuggestionTypeRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SuggestionTypeController extends Controller
{
    private SuggestionTypeRepositoryInterface $suggestionTypeRepository;

    public function __construct(SuggestionTypeRepositoryInterface $suggestionTypeRepository)
    {
        $this->suggestionTypeRepository = $suggestionTypeRepository;
    }

    /**
     * Страница со списком типов целей
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $suggestionTypes = $this->suggestionTypeRepository->all();
        return view('admin.includes.partials.suggestionTypes.index', compact('suggestionTypes'));
    }

    /**
     * Форма создания типа цели
     *
     * @return Application|Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.includes.partials.suggestionTypes.form', [
            'action_route' => route('admin.suggestion-types.store'),
            'action_method' => 'POST',
            'action_name' => __('base.general.create'),
        ]);
    }

    /**
     * Форма редактирования типа цели
     *
     * @param Request $request
     * @return Application|Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $suggestionType = $this->suggestionTypeRepository->find($request->route('id'));
        return view('admin.includes.partials.suggestionTypes.form', [
            'suggestionType' => $suggestionType,
            'action_route' => route('admin.suggestion-types.update', $suggestionType->id),
            'action_method' => 'PUT',
            'action_name' => __('base.general.save'),
        ]);
    }

    /**
     * Создание нового типа цели
     *
     * @param SuggestionTypeRequest $request
     * @return RedirectResponse
     */
    public function store(SuggestionTypeRequest $request): RedirectResponse
    {
        try {
            $this->suggestionTypeRepository->create(Arr::only($request->input(), ['title_ru', 'title_en']));
        } catch (Exception $e) {
            return back()
                ->withErrors( $e->getMessage() );
        }

        return redirect()->route('admin.suggestion-types.index');
    }

    /**
     * Изменение типа цели
     *
     * @param SuggestionTypeRequest $request
     * @return RedirectResponse
     */
    public function update(SuggestionTypeRequest $request): RedirectResponse
    {
        try {
            $this->suggestionTypeRepository->where([
                'id' => $request->route('id')
            ])->update(Arr::only($request->input(), ['title_ru', 'title_en']));
        } catch (Exception $e) {
            return back()
                ->withErrors( $e->getMessage() );
        }

        return redirect()->route('admin.suggestion-types.index');
    }

    /**
     * Удаление типа цели
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->suggestionTypeRepository->destroy($id);
        } catch (Exception $e) {
            return back()
                ->withErrors( $e->getMessage() );
        }

        return redirect()->route('admin.suggestion-types.index');
    }
}
