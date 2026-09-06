<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentFeatureVector extends Model
{
    use HasFactory;

    public const UPDATED_AT = null;

    protected $fillable = ['article_id', 'ml_model_run_id', 'vector'];

    protected $casts = ['vector' => 'array', 'created_at' => 'datetime'];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    public function mlModelRun(): BelongsTo
    {
        return $this->belongsTo(MlModelRun::class);
    }
}
