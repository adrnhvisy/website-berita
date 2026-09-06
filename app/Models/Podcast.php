<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Podcast extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'host_name', 'thumbnail_url', 'status'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'podcast_follows');
    }

    public function episodes(): HasMany
    {
        return $this->hasMany(Episode::class);
    }

    public function userEvents(): HasMany
    {
        return $this->hasMany(UserEvent::class);
    }

    public function podcastFollows(): HasMany
    {
        return $this->hasMany(PodcastFollow::class);
    }
}
