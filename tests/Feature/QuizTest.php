<?php

namespace Tests\Feature;

use App\Models\QuizQuestion;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuizTest extends TestCase
{
    use RefreshDatabase;

    private function createUser(): User
    {
        $role = Role::create(['nama_role' => 'user']);
        return User::factory()->create(['id_role' => $role->id_role]);
    }

    public function test_quiz_page_is_accessible()
    {
        $user = $this->createUser();

        QuizQuestion::create([
            'question' => 'Which SDG is about clean water?',
            'options' => ['SDG 1', 'SDG 6', 'SDG 10', 'SDG 15'],
            'answer' => 'SDG 6',
        ]);

        $response = $this->actingAs($user)->get(route('quiz'));

        $response->assertStatus(200);
    }

    public function test_quiz_submission_saves_score()
    {
        $user = $this->createUser();

        $q1 = QuizQuestion::create([
            'question' => 'Which SDG is about clean water?',
            'options' => ['SDG 1', 'SDG 6', 'SDG 10', 'SDG 15'],
            'answer' => 'SDG 6',
        ]);

        $this->actingAs($user)->get(route('quiz'));

        $response = $this->actingAs($user)->post(route('quiz.result'), [
            'answers' => [0 => 'SDG 6'],
        ]);

        $response->assertStatus(200);
        $response->assertSee(20);
    }
}
