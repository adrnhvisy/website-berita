<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentClusterAssignment extends Model
{
    use HasFactory;

    public const UPDATED_AT = null;

    protected $fillable = ['article_id', 'content_cluster_id', 'ml_model_run_id', 'distance_to_centroid', 'assigned_at'];

    protected $casts = ['distance_to_centroid' => 'decimal:6', 'assigned_at' => 'datetime'];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    public function contentCluster(): BelongsTo
    {
        return $this->belongsTo(ContentCluster::class);
    }

    public function mlModelRun(): BelongsTo
    {
        return $this->belongsTo(MlModelRun::class);
    }
}
