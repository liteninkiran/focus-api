<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\Http;

class QuestionController extends Controller
{
    public function fetchInsert() {
        $url = 'https://quizapi.io/api/v1/questions';
        $data = [
            'apiKey' => 'U3NaHtEozWSEClebQhKrYRvpprkiNmmPsN0nXPNR',
            'limit' => 10,
        ];
        $response = Http::get($url, $data);
        $questions = json_decode($response->body());
        foreach($questions as $q) {
            $question = new Question();
            $question->question = $q->question;
            $question->answer_a = $q->answers->answer_a;
            $question->answer_b = $q->answers->answer_b;
            $question->answer_c = $q->answers->answer_c;
            $question->save();
        }
        return $questions;
    }

    public function show() {
        $data['questions'] = Question::all();
        return view('welcome', $data);
    }
}
