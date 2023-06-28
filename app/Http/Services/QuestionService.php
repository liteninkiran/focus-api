<?php

namespace App\Http\Services;

use App\Models\Question;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class QuestionService
{
    /**
     * @param int $limit
     * @return void
     */
    public function fetchInsert(int $limit = 10): void {
        $url = 'https://quizapi.io/api/v1/questions';
        $data = [
            'apiKey' => 'U3NaHtEozWSEClebQhKrYRvpprkiNmmPsN0nXPNR',
            'limit' => $limit,
        ];
        $response = Http::get($url, $data);
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
    private function storeQuestion($question): void {
        $q = new Question();
        $q->question = $question->question;
        $q->answer_a = $question->answers->answer_a;
        $q->answer_b = $question->answers->answer_b;
        $q->answer_c = $question->answers->answer_c;
        $q->save();
    }
}
