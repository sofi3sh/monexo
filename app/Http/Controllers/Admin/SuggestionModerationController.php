<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Suggestion\SuggestionRepositoryInterface;
use Illuminate\Contracts\View\View;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SuggestionModerationController extends Controller
{
    private SuggestionRepositoryInterface $suggestionRepository;

    public function __construct(SuggestionRepositoryInterface $suggestionRepository)
    {
        $this->suggestionRepository = $suggestionRepository;
    }

    /**
     * Страница со списком типов целей
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $suggestions = $this->suggestionRepository->all();
        return view('admin.includes.partials.suggestions.index', compact('suggestions'));
    }


    /**
     * Одобрение цели
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function apply(Request $request): RedirectResponse
    {
        try {
            $this->suggestionRepository->apply($request->route('id'));
        } catch (Exception $e) {
            return back()->withErrors( $e->getMessage() );
        }

        return redirect()->route('admin.suggestions.index');
    }

    /**
     * Одобрение цели
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function decline(Request $request): RedirectResponse
    {
        try {
            $this->suggestionRepository->decline($request->route('id'));
        } catch (Exception $e) {
            return back()->withErrors( $e->getMessage() );
        }

        return redirect()->route('admin.suggestions.index');
    }

    /**
     * Удаление цели
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        try {
            $this->suggestionRepository->destroy($request->route('id'));
        } catch (Exception $e) {
            return back()->withErrors( $e->getMessage() );
        }

        return redirect()->route('admin.suggestions.index');
    }
}
