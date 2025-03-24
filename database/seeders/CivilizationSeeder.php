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
            // Extract leader data
            if (isset($civData['leader'])) {
                $leaderData = $civData['leader'];
                unset($civData['leader']);
                
                // Create the LeaderData object first
                $leader = new LeaderData(
                    id: 0, // This will be overridden by database auto-increment
                    civilizationId: 0, // Temporary value, will be updated later
                    name: $leaderData['name'],
                    subtitle: $leaderData['subtitle'],
                    lived: $leaderData['lived'],
                    icon: $leaderData['icon'],
                    trait: $leaderData['trait'],
                    titles: $leaderData['titles'],
                    historicalInfo: $leaderData['historical_info'] ?? $leaderData['historicalInfo'] ?? [],
                );
                
                // Create the civilization data with the leader
                $civilizationData = CivilizationData::from([
                    ...$civData,
                    'leader' => $leader
                ]);
                
                // Create the civilization record
                $civilization = Civilization::create($civilizationData->toDatabase());
                
                // Update the leader with the correct civilization ID and save it
                $leader->civilizationId = $civilization->id;
                Leader::create($leader->toDatabase($civilization->id));
                
                $this->command->info("Imported: {$civilizationData->name}");
            } else {
                $this->command->warn("Skipped civilization without leader data: {$civData['name']}");
            }
        }

        $this->command->info("Civilization import complete!");
    }
}
