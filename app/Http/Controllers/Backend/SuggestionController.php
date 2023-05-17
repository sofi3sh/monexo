<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Suggestion\IndexSuggestionRequest;
use App\Http\Requests\Backend\Suggestion\StoreSuggestionRequest;
use App\Repositories\Suggestion\SuggestionRepositoryInterface;
use App\Repositories\SuggestionType\SuggestionTypeRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuggestionController extends Controller
{
    private SuggestionRepositoryInterface $suggestionRepository;
    private SuggestionTypeRepositoryInterface $suggestionTypeRepository;

    public function __construct(SuggestionRepositoryInterface $suggestionRepository,
                                SuggestionTypeRepositoryInterface $suggestionTypeRepository)
    {
        $this->suggestionRepository = $suggestionRepository;
        $this->suggestionTypeRepository = $suggestionTypeRepository;
    }

    /**
     * Страница со списком типов целей
     *
     * @param IndexSuggestionRequest $request
     * @return View
     */
    public function index(IndexSuggestionRequest $request): View
    {
        $typeId = $request->input('type_id');
        $suggestions = $this->suggestionRepository->getForUser($typeId);
        $types = $this->suggestionTypeRepository->all();

        return view('dashboard.suggestions.index', compact('suggestions', 'types'));
    }

    /**
     * Форма создания типа цели
     *
     * @return Application|Factory|\Illuminate\View\View|RedirectResponse
     */
    public function create()
    {
        if (auth()->user()->bonus_level > 0) {
            $types = $this->suggestionTypeRepository->all();

            return view('dashboard.suggestions.form', [
                'action_route' => route('home.suggestions.store'),
                'action_method' => 'POST',
                'action_name' => __('base.general.save'),
                'types' => $types
            ]);
        } else {
            return redirect()->route('home.suggestions.index');
        }
    }

    /**
     * Создание новой цели
     *
     * @param StoreSuggestionRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSuggestionRequest $request): RedirectResponse
    {
        if (auth()->user()->bonus_level > 0) {
            try {
                $this->suggestionRepository->create([
                    'title' => $request->input('title'),
                    'text' => $request->input('text'),
                    'user_id' => Auth::user()->id,
                    'type_id' => $request->input('type_id'),
                ]);
            } catch (Exception $e) {
                return back()
                    ->withErrors($e->getMessage());
            }
        }

        return redirect()->route('home.suggestions.index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|\Illuminate\Http\Response|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function like(Request $request)
    {
        try {
            $this->suggestionRepository->like($request->route('id'));
        } catch (Exception $e) {
            return response()->json(['result' => false]);
        }

        return response()->json(['result' => true]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|\Illuminate\Http\Response|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function dislike(Request $request)
    {
        try {
            $this->suggestionRepository->dislike($request->route('id'));
        } catch (Exception $e) {
            return response()->json(['result' => false]);
        }

        return response()->json(['result' => true]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|\Illuminate\Http\Response|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function unlike(Request $request)
    {
        try {
            $this->suggestionRepository->unlike($request->route('id'));
        } catch (Exception $e) {
            return response()->json(['result' => false]);
        }

        return response()->json(['result' => true]);
    }

    /**
     * Удаление цели
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->suggestionRepository->destroy($id);
        } catch (Exception $e) {
            return back()
                ->withErrors( $e->getMessage() );
        }

        return redirect()->route('home.suggestions.index');
    }
}
