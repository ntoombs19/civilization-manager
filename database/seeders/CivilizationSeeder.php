<?php

namespace Database\Seeders;

use App\Models\Civilization;
use App\Models\Leader;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CivilizationSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = database_path('civilizations.json');

        if (!File::exists($jsonPath)) {
            $this->command->error("civilizations.json file not found at $jsonPath");
            return;
        }

        try {
            $civilizationsData = json_decode(File::get($jsonPath), true);
        } catch (FileNotFoundException $e) {
            $this->command->error("civilizations.json file could not be read: " . $e->getMessage());
            return;
        }

        if (!$civilizationsData || !is_array($civilizationsData)) {
            $this->command->error("Error decoding JSON or invalid format");
            return;
        }

        $this->command->info("Importing " . count($civilizationsData) . " civilizations...");

        foreach ($civilizationsData as $civData) {
            $leaderData = $civData['leader'] ?? null;

            // Prevent leader data from being used in the civilization data
            unset($civData['leader']);

            $civilization = Civilization::create([
                'id' => $civData['id'] ?? null,
                'name' => $civData['name'] ?? '',
                'icon' => $civData['icon'] ?? null,
                'dawn_of_man' => $civData['dawn_of_man'] ?? null,
                'unique_buildings' => $civData['unique_buildings'] ?? [],
                'unique_units' => $civData['unique_units'] ?? [],
                'city_names' => $civData['city_names'] ?? [],
                'spy_names' => $civData['spy_names'] ?? [],
                'historical_info' => $civData['historical_info'] ?? [],
                'url' => $civData['url'] ?? null,
            ]);

            if ($leaderData) {
                Leader::create([
                    'civilization_id' => $civilization->id,
                    'name' => $leaderData['name'] ?? '',
                    'subtitle' => $leaderData['subtitle'] ?? null,
                    'lived' => $leaderData['lived'] ?? null,
                    'icon' => $leaderData['icon'] ?? null,
                    'trait' => $leaderData['trait'] ?? null,
                    'titles' => $leaderData['titles'] ?? [],
                    'historical_info' => $leaderData['historical_info'] ?? [],
                ]);
            }

            $this->command->info("Imported: $civilization->name");
        }

        $this->command->info("Civilization import complete!");
    }
}
