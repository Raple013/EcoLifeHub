<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyHistory extends Model
{
    protected function casts(): array
    {
        return [
            'history_date' => 'datetime',
        ];
    }

    protected $fillable = [

        'user_id',

        'history_date',

        'quiz_score',

        'activity_minutes',

        'activity_calories'

    ];
}
