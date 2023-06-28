<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Question;
use App\Http\Services\QuestionService;
use \stdClass;
use Illuminate\Pagination\LengthAwarePaginator;

class QuestionServiceTest extends TestCase
{
    protected $questionService;

    protected function setUp(): void {
        parent::setUp();
        $this->questionService = $this->app->make(QuestionService::class);
    }

    /**
     * @test
     */
    public function testThatRecordsCanBeStoredToDatabase(): void
    {
        // Arrange
        $question = $this->getQuestion();
        $questionCountBefore = Question::count();

        // Act
        $this->questionService->storeQuestion($question);

        // Assert
        $this->assertEquals($questionCountBefore, Question::count() - 1);
    }

    /**
     * @test
     */
    public function testThatRecordsCanBeRetrieved(): void
    {
        // Act
        $questions = $this->questionService->getAllQuestions();

        // Assert
        $this->assertGreaterThan(0, $questions->count());
        $this->assertInstanceOf(LengthAwarePaginator::class, $questions);
    }

    /**
     * @test
     */
    public function testApiCanBeCalled(): void
    {
        // Act
        $response = $this->questionService->callApi();

        $this->assertEquals($response->getStatusCode(), 200);
    }

    private function getQuestion(): object
    {
        $answers = new stdClass();
        $answers->answer_a = 'Answer A';
        $answers->answer_b = 'Answer B';
        $answers->answer_c = 'Answer C';

        $question = new stdClass();
        $question->question = 'Test question';
        $question->answers = $answers;

        return $question;
    }
}
