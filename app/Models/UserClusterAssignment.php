<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserClusterAssignment extends Model
{
    use HasFactory;

    public const UPDATED_AT = null;

    protected $fillable = ['user_id', 'user_cluster_id', 'ml_model_run_id', 'distance_to_centroid', 'assigned_at'];

    protected $casts = ['distance_to_centroid' => 'decimal:6', 'assigned_at' => 'datetime'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function userCluster(): BelongsTo
    {
        return $this->belongsTo(UserCluster::class);
    }

    public function mlModelRun(): BelongsTo
    {
        return $this->belongsTo(MlModelRun::class);
    }
}
