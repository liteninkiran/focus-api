<?php

namespace App\Http\Services;

use App\Models\Question;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Client\Response;

class QuestionService
{
    /**
     * @param int $limit
     * @return void
     */
    public function fetchInsert(int $limit = 10): void {
        $response = $this->callApi($limit);
        $questions = json_decode($response->body());
        foreach($questions as $question) {
            $this->storeQuestion($question);
        }
    }

    /**
     * @return LengthAwarePaginator 
     */
    public function getAllQuestions(): LengthAwarePaginator  {
        return Question::paginate(5);
    }

    /**
     * @return void
     */
    public function storeQuestion($question): void {
        $q = new Question();
        $q->question = $question->question;
        $q->answer_a = $question->answers->answer_a;
        $q->answer_b = $question->answers->answer_b;
        $q->answer_c = $question->answers->answer_c;
        $q->save();
    }

    /**
     * @param int $limit
     * @return Response
     */
    public function callApi(int $limit = 10): Response {
        $url = 'https://quizapi.io/api/v1/questions';
        $data = [
            'apiKey' => 'U3NaHtEozWSEClebQhKrYRvpprkiNmmPsN0nXPNR',
            'limit' => $limit,
        ];
        return Http::get($url, $data);
    }
}
