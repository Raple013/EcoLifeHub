<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealLog extends Model
{
    protected $table = 'meal_logs';

    protected $fillable = [
        'user_id',
        'food_name',
        'calories',
        'protein_g',
        'carbs_g',
        'sugar_g',
        'fat_g',
        'meal_type',
        'image_url',
        'source',
        'logged_at',
    ];

    protected function casts(): array
    {
        return [
            'calories' => 'decimal:1',
            'protein_g' => 'decimal:1',
            'carbs_g' => 'decimal:1',
            'sugar_g' => 'decimal:1',
            'fat_g' => 'decimal:1',
            'logged_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
