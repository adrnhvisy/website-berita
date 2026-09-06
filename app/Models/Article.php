<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['episode_id', 'source_id', 'title', 'slug', 'excerpt', 'content', 'featured_image', 'published_at', 'status'];

    protected $casts = ['published_at' => 'datetime'];

    public function episode(): BelongsTo
    {
        return $this->belongsTo(Episode::class);
    }

    public function source(): BelongsTo
    {
        return $this->belongsTo(Source::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'article_category');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'article_tag');
    }

    public function articleLikes(): HasMany
    {
        return $this->hasMany(ArticleLike::class);
    }

    public function articleBookmarks(): HasMany
    {
        return $this->hasMany(ArticleBookmark::class);
    }

    public function userEvents(): HasMany
    {
        return $this->hasMany(UserEvent::class);
    }

    public function contentFeatureVectors(): HasMany
    {
        return $this->hasMany(ContentFeatureVector::class);
    }

    public function contentClusterAssignments(): HasMany
    {
        return $this->hasMany(ContentClusterAssignment::class);
    }
}
