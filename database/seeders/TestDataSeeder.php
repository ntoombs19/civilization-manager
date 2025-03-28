<?php

namespace Database\Seeders;

use App\Models\Civilization;
use App\Models\Leader;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create civilizations with associated leaders
        Civilization::factory()
            ->count(30)
            ->has(Leader::factory())
            ->create();
            
        // Create additional leaders for existing civilizations
        // This demonstrates how multiple leaders can be associated with civilizations
        Leader::factory()
            ->count(10)
            ->create();

        $this->command->info('Test data has been generated successfully!');
    }
} 