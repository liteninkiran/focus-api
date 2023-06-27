<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Question;
use App\Http\Services\QuestionService;

class QuestionController extends Controller
{
    /**
     * @param QuestionService $questionService
     * @return string
     */
    public function fetchInsert(QuestionService $questionService): string {
        $questionService->fetchInsert();
        return 'Questions retreived from third party API and stored locally in the database';
    }

    /**
     * @param QuestionService $questionService
     * @return View
     */
    public function show(QuestionService $questionService): View {
        $data['questions'] = $questionService->getAllQuestions();
        return view('welcome', $data);
    }
}
