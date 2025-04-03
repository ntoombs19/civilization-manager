<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Civilization extends Model
{
    protected $fillable = [
        'name',
        'icon',
        'dawn_of_man',
        'historical_info',
    ];

    protected $casts = [
        'historical_info' => 'array',
    ];

    public function leader(): HasOne
    {
        return $this->hasOne(Leader::class, 'civilization_id');
    }
}
