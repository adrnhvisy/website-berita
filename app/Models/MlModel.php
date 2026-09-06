<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MlModel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'model_type', 'description', 'version', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function mlModelRuns(): HasMany
    {
        return $this->hasMany(MlModelRun::class);
    }
}
