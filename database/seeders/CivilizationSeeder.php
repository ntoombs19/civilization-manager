<?php

namespace Database\Seeders;

use App\Data\CivilizationData;
use App\Data\LeaderData;
use App\Models\Civilization;
use App\Models\Leader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CivilizationSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = database_path('civilizations.json');

        if (!File::exists($jsonPath)) {
            $this->command->error("civilizations.json file not found at {$jsonPath}");
            return;
        }

        $civilizationsData = json_decode(File::get($jsonPath), true);

        if (!$civilizationsData || !is_array($civilizationsData)) {
            $this->command->error("Error decoding JSON or invalid format");
            return;
        }

        $this->command->info("Importing " . count($civilizationsData) . " civilizations...");

        foreach ($civilizationsData as $civData) {
            $civilizationData = CivilizationData::from($civData);

            $civilization = Civilization::create($civilizationData->toDatabase());

            if (isset($civData['leader'])) {
                $leaderData = LeaderData::from($civData['leader']);
                Leader::create($leaderData->toDatabase($civilization->id));
            }

            $this->command->info("Imported: {$civilizationData->name}");
        }

        $this->command->info("Civilization import complete!");
    }
}
