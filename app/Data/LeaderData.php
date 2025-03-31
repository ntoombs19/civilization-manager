<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\WithoutValidation;
use Spatie\TypeScriptTransformer\Attributes\LiteralTypeScriptType;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use Spatie\TypeScriptTransformer\Attributes\TypeScriptType;

#[TypeScript]
class LeaderData extends Data
{
    public function __construct(
        #[WithoutValidation]
        public int $id,
        #[MapInputName('civilization_id')]
        #[WithoutValidation]
        public int $civilizationId,
        public string $name,
        public string $subtitle,
        public string $lived,
        public string $icon,
        #[LiteralTypeScriptType('{name: string, effect: string}')]
        public array $trait,
        #[TypeScriptType('string[]')]
        public array $titles,
        #[MapInputName('historical_info')]
        #[LiteralTypeScriptType('Array<{text: string, heading: string}>')]
        public array $historicalInfo,
        public ?CivilizationData $civilization = null,
    ) {
    }

    /**
     * Transform the data object to a database-ready array
     */
    public function toDatabase(?int $civilizationId = null): array
    {
        return [
            'civilization_id' => $civilizationId ?? $this->civilizationId,
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
