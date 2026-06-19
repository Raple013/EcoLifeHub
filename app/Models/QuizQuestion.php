<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $fillable = ['question', 'options', 'answer', 'topic'];

    protected function casts(): array
    {
        return [
            'options' => 'array',
        ];
    }
}
