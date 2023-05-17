<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\VideoCoursesHelper;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AnswerController extends Controller
{
    private function getListModule(int $userId, int $moduleId)
    {
        return DB::table('answer')
            ->select(['questions.question', 'answer.answer'])
            ->leftJoin('questions', 'answer.question_id', '=', 'questions.id')
            ->where('answer.user_id' , '=', $userId)
            ->where('questions.module_id', '=', $moduleId)
            ->get();
    }

    private function store(Request $request)
    {
        $userId = $request->input('user_id');
        print_r($userId);
        return [
            'userId' => $userId
        ];
    }

    public function index(Request $request)
    {
        $listUser = User::select('id', 'email')
            ->whereIn('id', VideoCoursesHelper::getArrayUsersPaid())
            ->get();
        
        $checkedUser = null;

        $listModules = [];

        
        if ($request->isMethod('POST')) {
            $userId = intval($this->store($request)['userId']);
            print $userId;
            for($i = 1; $i <= 5; $i++) {
                $listModules[] = $this->getListModule($userId, $i);
            }

            $checkedUser = $userId;
        }

        return view('admin.answer-index', compact(
            'listUser',
            'checkedUser',
            'listModules',
        ));
    }
}
