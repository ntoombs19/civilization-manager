<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\WithoutValidation;
use Spatie\LaravelData\Optional;

class LeaderData extends Data
{
    public function __construct(
        #[WithoutValidation]
        public int|Optional $id = 0,
        #[MapInputName('civilization_id')]
        #[WithoutValidation]
        public int|Optional $civilizationId = 0,
        public string $name,
        public string $subtitle,
        public string $lived,
        public string $icon,
        public array $trait,
        public array $titles,
        #[MapInputName('historical_info')]
        public array $historicalInfo,
    ) {
    }

    /**
     * Transform the data object to a database-ready array
     */
    public function toDatabase(int $civilizationId): array
    {
        return [
            'civilization_id' => $civilizationId,
            'name' => $this->name,
            'subtitle' => $this->subtitle,
            'lived' => $this->lived,
            'icon' => $this->icon,
            'trait' => $this->trait,
            'titles' => $this->titles,
            'historical_info' => $this->historicalInfo,
        ];
    }
}
