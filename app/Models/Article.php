<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'excerpt',
        'content',
        'image_url',
        'source_url',
        'author',
        'language',
        'is_published',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function categoryIcon(): string
    {
        return match ($this->category) {
            'nutrition' => '&#129472;',
            'prevention' => '&#128137;',
            'mental' => '&#129504;',
            'environment' => '&#127757;',
            'fitness' => '&#127947;',
            default => '&#128214;',
        };
    }

    public function categoryLabel(): string
    {
        return match ($this->category) {
            'nutrition' => 'Nutrition & Diet',
            'prevention' => 'Disease Prevention',
            'mental' => 'Mental Health',
            'environment' => 'Environmental Health',
            'fitness' => 'Fitness & Exercise',
            default => 'General',
        };
    }

    public function categoryColor(): string
    {
        return match ($this->category) {
            'nutrition' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
            'prevention' => 'bg-red-100 text-red-700 border-red-200',
            'mental' => 'bg-purple-100 text-purple-700 border-purple-200',
            'environment' => 'bg-green-100 text-green-700 border-green-200',
            'fitness' => 'bg-orange-100 text-orange-700 border-orange-200',
            default => 'bg-sage-100 text-sage-700 border-sage-200',
        };
    }

    public function excerptPreview(int $words = 25): string
    {
        return $this->excerpt
            ? Str::words($this->excerpt, $words)
            : Str::words(strip_tags($this->content), $words);
    }

    public function readingTime(): string
    {
        $minutes = (int) ceil(str_word_count(strip_tags($this->content)) / 200);
        return $minutes < 1 ? '1 min read' : "{$minutes} min read";
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function languageLabel(): string
    {
        return match ($this->language) {
            'id' => 'Bahasa Indonesia',
            default => 'English',
        };
    }
}
