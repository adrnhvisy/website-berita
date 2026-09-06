<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'username', 'email', 'password', 'avatar', 'status'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function listeningHistories(): HasMany
    {
        return $this->hasMany(ListeningHistory::class);
    }

    public function userEvents(): HasMany
    {
        return $this->hasMany(UserEvent::class);
    }

    public function articleLikes(): HasMany
    {
        return $this->hasMany(ArticleLike::class);
    }

    public function articleBookmarks(): HasMany
    {
        return $this->hasMany(ArticleBookmark::class);
    }

    public function podcasts(): BelongsToMany
    {
        return $this->belongsToMany(Podcast::class, 'podcast_follows');
    }

    public function userFeatureVectors(): HasMany
    {
        return $this->hasMany(UserFeatureVector::class);
    }

    public function userClusterAssignments(): HasMany
    {
        return $this->hasMany(UserClusterAssignment::class);
    }

    public function auditLogs(): HasMany
    {
        return $this->hasMany(AuditLog::class);
    }
}
