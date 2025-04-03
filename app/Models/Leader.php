<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Leader extends Model
{
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
