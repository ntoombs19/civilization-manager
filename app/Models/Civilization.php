<?php

namespace App\Models;

use Database\Factories\CivilizationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Civilization extends Model
{
    /** @use HasFactory<CivilizationFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'dawn_of_man',
        'unique_buildings',
        'unique_units',
        'city_names',
        'spy_names',
        'historical_info',
        'url',
    ];

    protected $casts = [
        'unique_buildings' => 'array',
        'unique_units' => 'array',
        'city_names' => 'array',
        'spy_names' => 'array',
        'historical_info' => 'array',
    ];

    public function leader(): HasOne
    {
        return $this->hasOne(Leader::class, 'civilization_id');
    }
}
