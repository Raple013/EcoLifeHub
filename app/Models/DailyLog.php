<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyLog extends Model
{
    protected $table = 'daily_logs';

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
        'activity_calories',
    ];
}
