<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Question;
use App\Http\Services\QuestionService;

class QuestionController extends Controller
{
    /**
     * @param QuestionService $questionService
     * @return RedirectResponse
     */
    public function fetchInsert(QuestionService $questionService): RedirectResponse {
        $questionService->fetchInsert();
        return redirect()->to('/');
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
