<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscussionThread extends Model
{
    protected $fillable = ['user_id', 'title', 'body', 'category', 'is_pinned', 'is_locked'];

    protected function casts(): array
    {
        return [
            'is_pinned' => 'boolean',
            'is_locked' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(DiscussionReply::class, 'thread_id');
    }

    public function scopePinnedFirst($query)
    {
        return $query->orderBy('is_pinned', 'desc')->latest();
    }
}
