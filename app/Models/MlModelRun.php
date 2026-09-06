<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MlModelRun extends Model
{
    use HasFactory;

    public const UPDATED_AT = null;

    protected $fillable = ['ml_model_id', 'run_identifier', 'k_value', 'feature_schema', 'dataset_size', 'metrics', 'started_at', 'completed_at', 'status'];

    protected $casts = [
        'feature_schema' => 'array',
        'metrics' => 'array',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'k_value' => 'integer',
        'dataset_size' => 'integer',
    ];

    public function mlModel(): BelongsTo
    {
        return $this->belongsTo(MlModel::class);
    }

    public function userFeatureVectors(): HasMany
    {
        return $this->hasMany(UserFeatureVector::class);
    }

    public function userClusters(): HasMany
    {
        return $this->hasMany(UserCluster::class);
    }

    public function userClusterAssignments(): HasMany
    {
        return $this->hasMany(UserClusterAssignment::class);
    }

    public function contentFeatureVectors(): HasMany
    {
        return $this->hasMany(ContentFeatureVector::class);
    }

    public function contentClusters(): HasMany
    {
        return $this->hasMany(ContentCluster::class);
    }

    public function contentClusterAssignments(): HasMany
    {
        return $this->hasMany(ContentClusterAssignment::class);
    }
}
