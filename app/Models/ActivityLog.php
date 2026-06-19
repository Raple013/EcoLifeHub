<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id',
        'activity_type',
        'pace_intensity',
        'duration_minutes',
        'distance_km',
        'calories_burned',
        'weight_kg',
        'activity_date',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'activity_date' => 'date',
            'weight_kg' => 'decimal:1',
            'distance_km' => 'decimal:2',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function icon(): string
    {
        return match ($this->activity_type) {
            'walking' => '&#128694;',
            'running' => '&#127939;',
            'cycling' => '&#128690;',
            'swimming' => '&#127946;',
            'yoga' => '&#129518;',
            'strength' => '&#128170;',
            'dancing' => '&#128131;',
            'hiking' => '&#9968;',
            'sports' => '&#127944;',
            default => '&#127775;',
        };
    }

    public function label(): string
    {
        return match ($this->activity_type) {
            'walking' => 'Walking',
            'running' => 'Running / Jogging',
            'cycling' => 'Cycling',
            'swimming' => 'Swimming',
            'yoga' => 'Yoga / Stretching',
            'strength' => 'Strength Training',
            'dancing' => 'Dancing',
            'hiking' => 'Hiking',
            'sports' => 'Sports',
            default => 'Other',
        };
    }

    public static function getMetValue(string $activity, string $intensity): float
    {
        $metTable = [
            'walking' => [
                'slow' => 2.8,
                'moderate' => 3.5,
                'brisk' => 4.3,
                'fast' => 5.0,
            ],
            'running' => [
                'light_jog' => 8.0,
                'moderate_run' => 11.0,
                'fast_run' => 12.5,
                'sprint' => 14.0,
            ],
            'cycling' => [
                'leisure' => 4.0,
                'moderate' => 6.0,
                'fast' => 8.0,
                'vigorous' => 10.0,
            ],
            'swimming' => [
                'light' => 6.0,
                'moderate' => 8.0,
                'vigorous' => 10.0,
            ],
            'yoga' => [
                'gentle' => 2.0,
                'hatha' => 2.5,
                'power' => 4.0,
            ],
            'strength' => [
                'light' => 3.0,
                'moderate' => 5.0,
                'vigorous' => 6.0,
            ],
            'dancing' => [
                'slow' => 3.0,
                'moderate' => 5.0,
                'fast' => 7.0,
            ],
            'hiking' => [
                'flat' => 4.0,
                'moderate' => 6.0,
                'steep' => 8.0,
            ],
            'sports' => [
                'casual' => 5.0,
                'moderate' => 6.5,
                'competitive' => 8.0,
            ],
        ];

        return $metTable[$activity][$intensity] ?? 3.0;
    }

    public static function calculateCalories(float $met, float $weightKg, int $durationMinutes): int
    {
        return (int) round($met * $weightKg * ($durationMinutes / 60));
    }
}
