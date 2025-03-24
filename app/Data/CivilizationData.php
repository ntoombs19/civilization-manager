<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\WithoutValidation;

class CivilizationData extends Data
{
    public function __construct(
        #[WithoutValidation]
        public int $id,
        public string $name,
        public string $icon,
        #[MapInputName('dawn_of_man')]
        public string $dawnOfMan,
        #[MapInputName('unique_buildings')]
        public array $uniqueBuildings,
        #[MapInputName('unique_units')]
        public array $uniqueUnits,
        #[MapInputName('city_names')]
        public array $cityNames,
        #[MapInputName('spy_names')]
        public array $spyNames,
        #[MapInputName('historical_info')]
        public array $historicalInfo,
        public string $url,
        public LeaderData $leader,
    ) {
    }

    /**
     * Transform the data object to a database-ready array
     */
    public function toDatabase(): array
    {
        return [
            'name' => $this->name,
            'icon' => $this->icon,
            'dawn_of_man' => $this->dawnOfMan,
            'unique_buildings' => $this->uniqueBuildings,
            'unique_units' => $this->uniqueUnits,
            'city_names' => $this->cityNames,
            'spy_names' => $this->spyNames,
            'historical_info' => $this->historicalInfo,
            'url' => $this->url,
        ];
    }
}
