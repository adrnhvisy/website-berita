<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListeningHistory extends Model
{
    use HasFactory;

    public const UPDATED_AT = null;

    protected $fillable = ['user_id', 'episode_id', 'started_at', 'ended_at', 'listened_duration_seconds', 'last_position_seconds', 'completed'];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
        'listened_duration_seconds' => 'integer',
        'last_position_seconds' => 'integer',
        'completed' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function episode(): BelongsTo
    {
        return $this->belongsTo(Episode::class);
    }
}
