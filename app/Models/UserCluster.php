<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserCluster extends Model
{
    use HasFactory;

    protected $fillable = ['ml_model_run_id', 'cluster_index', 'name', 'description', 'centroid'];

    protected $casts = ['centroid' => 'array', 'cluster_index' => 'integer'];

    public function mlModelRun(): BelongsTo
    {
        return $this->belongsTo(MlModelRun::class);
    }

    public function userClusterAssignments(): HasMany
    {
        return $this->hasMany(UserClusterAssignment::class);
    }
}
