<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
        'weight_kg',
        'height_cm',
        'gender',
        'age',
        'date_of_birth',
        'city',
        'id_role',
        'status',
        'quiz_score',
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
            'date_of_birth' => 'date',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id_role');
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function dailyLogs()
    {
        return $this->hasMany(DailyLog::class);
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

    public function mealLogs()
    {
        return $this->hasMany(MealLog::class);
    }

    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
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

        $earned = Achievement::whereIn('level', array_keys(array_filter($criteria)))
            ->pluck('id')
            ->toArray();

        $this->achievements()->syncWithoutDetaching(
            collect($earned)->mapWithKeys(fn($id) => [$id => ['earned_at' => now()]])->toArray()
        );
    }

    public function highestAchievement(): ?Achievement
    {
        return $this->achievements()->orderBy('level', 'desc')->first();
    }

    public function photoUrl(): string
    {
        return $this->profile_photo
            ? asset('storage/' . $this->profile_photo)
            : '';
    }

    public function hasPhoto(): bool
    {
        return !is_null($this->profile_photo);
    }

    public function initials(): string
    {
        return strtoupper(substr($this->name, 0, 1));
    }

    public function isBlocked(): bool
    {
        return $this->status === 'nonaktif';
    }

    public function block(string $reason = null): void
    {
        $this->update([
            'status' => 'nonaktif',
        ]);
    }

    public function unblock(): void
    {
        $this->update([
            'status' => 'aktif',
        ]);
    }

    public function hasRole(string $namaRole): bool
    {
        return $this->role?->nama_role === $namaRole;
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
}
