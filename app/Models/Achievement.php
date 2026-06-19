<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = ['name', 'description', 'level'];

    const COLORS = [
        1 => 'bg-sage-100 text-sage-700 border-sage-200',
        2 => 'bg-forest-100 text-forest-700 border-forest-200',
        3 => 'bg-gold-100 text-gold-700 border-gold-200',
        4 => 'bg-clay-100 text-clay-700 border-clay-200',
        5 => 'bg-ink text-cream border-ink border',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('earned_at');
    }

    public function getColorClassAttribute(): string
    {
        return self::COLORS[$this->level] ?? self::COLORS[1];
    }
}
