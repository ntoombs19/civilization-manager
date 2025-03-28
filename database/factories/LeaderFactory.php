<?php

namespace Database\Factories;

use App\Models\Civilization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Leader>
 */
class LeaderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'civilization_id' => Civilization::factory(),
            'name' => $this->faker->firstName() . ' ' . $this->faker->lastName(),
            'subtitle' => 'Leader of ' . $this->faker->country(),
            'lived' => $this->faker->numberBetween(1000, 1800) . ' - ' . $this->faker->numberBetween(1801, 1950) . ' AD',
            'icon' => $this->faker->imageUrl(64, 64, 'leader', true),
            'trait' => json_encode([
                'name' => $this->faker->word() . ' ' . $this->faker->randomElement(['Legacy', 'Wisdom', 'Conquest', 'Trade', 'Diplomacy']),
                'effect' => $this->faker->paragraph(1)
            ]),
            'titles' => json_encode([
                $this->faker->randomElement(['King', 'Queen', 'Emperor', 'Empress', 'Sultan', 'Pharaoh', 'Chief']),
                $this->faker->randomElement(['The Great', 'The Wise', 'The Conqueror', 'The Magnificent', 'The Terrible'])
            ]),
            'historical_info' => json_encode([
                [
                    'heading' => 'History',
                    'text' => $this->faker->paragraphs(2, true)
                ],
                [
                    'heading' => 'Early Life',
                    'text' => $this->faker->paragraphs(1, true)
                ],
                [
                    'heading' => 'Reign',
                    'text' => $this->faker->paragraphs(1, true)
                ],
                [
                    'heading' => 'Legacy',
                    'text' => $this->faker->paragraphs(1, true)
                ]
            ])
        ];
    }
}
