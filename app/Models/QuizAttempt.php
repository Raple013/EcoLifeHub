<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    protected $fillable = [
        'user_id',
        'score',
        'total_questions',
        'topic',
        'answers',
        'started_at',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
            'answers' => 'array',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
