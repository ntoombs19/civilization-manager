<?php

namespace App\Models;

use Database\Factories\LeaderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Leader extends Model
{
    /** @use HasFactory<LeaderFactory> */
    use HasFactory;

    protected $fillable = [
        'civilization_id',
        'name',
        'subtitle',
        'lived',
        'icon',
        'trait',
        'titles',
        'historical_info',
    ];

    protected $casts = [
        'trait' => 'array',
        'titles' => 'array',
        'historical_info' => 'array',
    ];

    public function civilization(): BelongsTo
    {
        return $this->belongsTo(Civilization::class);
    }
}
