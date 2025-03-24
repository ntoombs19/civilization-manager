<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\WithoutValidation;
use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\LiteralTypeScriptType;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use Spatie\TypeScriptTransformer\Attributes\TypeScriptType;

/**
 * @property int $id
 * @property int $civilizationId
 * @property string $name
 * @property string $subtitle
 * @property string $lived
 * @property string $icon
 * @property array{name: string, description: string} $trait
 * @property string[] $titles
 * @property array{title: string, content: string}[] $historicalInfo
 */
#[TypeScript]
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
        #[LiteralTypeScriptType('{name: string, effect: string}')]
        public array $trait,
        #[TypeScriptType('string[]')]
        public array $titles,
        #[MapInputName('historical_info')]
        #[LiteralTypeScriptType('Array<{text: string, heading: string}>')]
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
