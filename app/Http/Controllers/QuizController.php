<?php

namespace App\Http\Controllers;

use App\Models\DailyLog;
use App\Models\QuizAttempt;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(Request $request)
    {
        $count = min(max((int) $request->count, 3), 10);
        $topic = $request->topic;

        $query = QuizQuestion::inRandomOrder();

        if ($topic && $topic !== 'all') {
            $query->where('topic', $topic);
        }

        $questions = $query->take($count)->get();

        session([
            'quiz_questions' => $questions->toArray(),
            'quiz_count' => $count,
        ]);

        return view('quiz', compact('questions', 'count', 'topic'));
    }

    public function result(Request $request)
    {
        $questions = session('quiz_questions', []);
        $count = session('quiz_count', count($questions));

        $perQuestion = match (true) {
            $count >= 10 => 10,
            $count >= 5 => 20,
            default => [34, 33, 33],
        };

        $correct = 0;
        $results = [];

        foreach ($questions as $index => $question) {
            $userAnswer = $request->answers[$index] ?? null;
            $isCorrect = $userAnswer === $question['answer'];
            if ($isCorrect) {
                $correct += is_array($perQuestion) ? $perQuestion[$index] : $perQuestion;
            }
            $results[] = [
                'question_id' => $question['id'],
                'question' => $question['question'],
                'options' => $question['options'],
                'correct_answer' => $question['answer'],
                'user_answer' => $userAnswer,
                'is_correct' => $isCorrect,
            ];
        }

        $score = $correct;

        $user = auth()->user();
        $user->update(['quiz_score' => $score]);

        QuizAttempt::create([
            'user_id' => $user->id,
            'score' => $score,
            'total_questions' => $count,
            'topic' => $questions[0]['topic'] ?? null,
            'answers' => $results,
            'completed_at' => now(),
        ]);

        DailyLog::updateOrCreate(
            [
                'user_id' => $user->id,
                'history_date' => now()->toDateString(),
            ],
            ['quiz_score' => $score]
        );

        return view('quiz-result', compact('score', 'results', 'count'));
    }
}
