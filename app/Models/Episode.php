<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = ['podcast_id', 'title', 'slug', 'description', 'audio_url', 'thumbnail_url', 'duration_seconds', 'transcript', 'published_at', 'status'];

    protected $casts = [
        'duration_seconds' => 'integer',
        'published_at' => 'datetime',
    ];

    public function podcast(): BelongsTo
    {
        return $this->belongsTo(Podcast::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function listeningHistories(): HasMany
    {
        return $this->hasMany(ListeningHistory::class);
    }

    public function userEvents(): HasMany
    {
        return $this->hasMany(UserEvent::class);
    }
}
