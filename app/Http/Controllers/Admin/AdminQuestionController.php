<?php

namespace App\Http\Controllers\Admin;

use App\Models\Home\Question;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Consts\QuestionConstants;
use Illuminate\Http\RedirectResponse;
use Exception;

class AdminQuestionController extends Controller
{
    /**
     * Вывод списка вопросов.
     *
     * @return View
     */
    public function index(): View
    {
        $listQuestion = Question::all();
        return view('admin.question-index', compact('listQuestion'));
    }

    /**
     * Создание вопроса
     *
     * @return View
     */
    public function create(): View
    {
        $listModule = QuestionConstants::MODULE;
        return view('admin.question-show', compact('listModule'));
    }

    /**
     * Редактиование вопросов.
     *
     * @param Question $question
     * @return View
     */
    public function edit(Question $question): View
    {
        $listModule = QuestionConstants::MODULE;
        return view('admin.question-show', compact('question', 'listModule'));
    }

    /**
     * Сохранение вопросов.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'module_id' => 'required',
            'question' => 'required',
        ]);

        try {
            Question::on()->updateOrCreate(['id' => $request->id], [
                'module_id' => $request->module_id,
                'question' => $request->question,
            ]);

            return redirect()->route('admin.mlmup2question');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors( $e->getMessage() );
        }
    }

    /**
     * Удаление вопросов.
     *
     * @param Question $question
     * @return RedirectResponse
     */
    public function destroy(Question $question): RedirectResponse
    {
        try {
            $question->delete();
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.mlmup2question');
    }
}
