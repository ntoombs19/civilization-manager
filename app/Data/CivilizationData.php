<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\WithoutValidation;
use Spatie\TypeScriptTransformer\Attributes\LiteralTypeScriptType;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use Spatie\TypeScriptTransformer\Attributes\TypeScriptType;

#[TypeScript]
class CivilizationData extends Data
{
    public function __construct(
        #[WithoutValidation]
        public int $id,
        public string $name,
        public string $icon,
        #[MapInputName('dawn_of_man')]
        public string $dawnOfMan,
        #[MapInputName('historical_info')]
        #[LiteralTypeScriptType('Array<{text: string, heading: string}>')]
        public array $historicalInfo,
        public ?LeaderData $leader = null,
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
            'historical_info' => $this->historicalInfo,
        ];
    }
}
