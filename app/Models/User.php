<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'weight_kg',
        'height_cm',
        'city',
        'quiz_score',
        'profile_photo_path',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'weight_kg' => 'decimal:1',
        ];
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function dailyHistories()
    {
        return $this->hasMany(DailyHistory::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function threads()
    {
        return $this->hasMany(DiscussionThread::class);
    }

    public function replies()
    {
        return $this->hasMany(DiscussionReply::class);
    }

    public function nutritionLogs()
    {
        return $this->hasMany(NutritionLog::class);
    }

    public function achievements()
    {
        return $this->belongsToMany(Achievement::class)->withPivot('earned_at');
    }

    public function syncAchievements(): void
    {
        $totalMinutes = $this->activityLogs()->sum('duration_minutes') ?? 0;
        $quizScore = $this->quiz_score ?? 0;

        $criteria = [
            1 => true,
            2 => $totalMinutes >= 50,
            3 => $totalMinutes >= 200 || $quizScore >= 80,
            4 => $quizScore >= 90,
            5 => $totalMinutes >= 500 && $quizScore >= 90,
        ];

        $earned = \App\Models\Achievement::whereIn('level', array_keys(array_filter($criteria)))
            ->pluck('id')
            ->toArray();

        $this->achievements()->syncWithoutDetaching(
            collect($earned)->mapWithKeys(fn($id) => [$id => ['earned_at' => now()]])->toArray()
        );
    }

    public function highestAchievement(): ?\App\Models\Achievement
    {
        return $this->achievements()->orderBy('level', 'desc')->first();
    }

    public function photoUrl(): string
    {
        return $this->profile_photo_path
            ? asset('storage/' . $this->profile_photo_path)
            : '';
    }

    public function hasPhoto(): bool
    {
        return !is_null($this->profile_photo_path);
    }

    public function initials(): string
    {
        return strtoupper(substr($this->name, 0, 1));
    }

    public function bmi(): ?float
    {
        if (!$this->weight_kg || !$this->height_cm || $this->height_cm <= 0) {
            return null;
        }
        $heightM = $this->height_cm / 100;
        return round($this->weight_kg / ($heightM * $heightM), 1);
    }

    public function bmiStatus(): ?string
    {
        $bmi = $this->bmi();
        if ($bmi === null) return null;

        return match (true) {
            $bmi < 18.5 => 'Underweight',
            $bmi < 23 => 'Normal (Ideal)',
            $bmi < 25 => 'Overweight',
            $bmi >= 25 => 'Obese',
        };
    }

    public function bmiStatusClass(): ?string
    {
        $bmi = $this->bmi();
        if ($bmi === null) return null;

        return match (true) {
            $bmi < 18.5 => 'bg-blue-100 text-blue-700 border-blue-200',
            $bmi < 23 => 'bg-green-100 text-green-700 border-green-200',
            $bmi < 25 => 'bg-yellow-100 text-yellow-700 border-yellow-200',
            $bmi >= 25 => 'bg-red-100 text-red-700 border-red-200',
        };
    }

    public function bmiEmoji(): ?string
    {
        $bmi = $this->bmi();
        if ($bmi === null) return null;

        return match (true) {
            $bmi < 18.5 => '&#128564;',
            $bmi < 23 => '&#128170;',
            $bmi < 25 => '&#9888;',
            $bmi >= 25 => '&#128162;',
        };
    }
}
