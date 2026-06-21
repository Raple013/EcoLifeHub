<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
    public function index()
    {
        $questions = QuizQuestion::latest()->paginate(20);
        $totalAll = QuizQuestion::count();
        return view('admin.quiz-questions.index', compact('questions', 'totalAll'));
    }

    public function create()
    {
        return view('admin.quiz-questions.form', ['question' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|max:500',
            'options' => 'required|array|min:2|max:6',
            'options.*' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
            'explanation' => 'nullable|string|max:1000',
        ]);

        $data['options'] = array_values($data['options']);

        QuizQuestion::create($data);

        return redirect()->route('admin.quiz-questions.index')
            ->with('success', __('Quiz question created.'));
    }

    public function edit(QuizQuestion $quizQuestion)
    {
        return view('admin.quiz-questions.form', ['question' => $quizQuestion]);
    }

    public function update(Request $request, QuizQuestion $quizQuestion)
    {
        $data = $request->validate([
            'question' => 'required|max:500',
            'options' => 'required|array|min:2|max:6',
            'options.*' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
            'explanation' => 'nullable|string|max:1000',
        ]);

        $data['options'] = array_values($data['options']);

        $quizQuestion->update($data);

        return redirect()->route('admin.quiz-questions.index')
            ->with('success', __('Quiz question updated.'));
    }

    public function destroy(QuizQuestion $quizQuestion)
    {
        $quizQuestion->delete();
        return redirect()->route('admin.quiz-questions.index')
            ->with('success', __('Quiz question deleted.'));
    }
}
