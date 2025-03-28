<?php

namespace Database\Factories;

use App\Models\Civilization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Civilization>
 */
class CivilizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->country(),
            'icon' => $this->faker->imageUrl(64, 64, 'civilization', true),
            'dawn_of_man' => $this->faker->paragraph(3),
            'unique_buildings' => json_encode([
                [
                    'name' => $this->faker->word() . ' ' . $this->faker->randomElement(['Temple', 'Palace', 'Shrine', 'Market', 'Workshop']),
                    'replaces' => $this->faker->randomElement(['Temple', 'Palace', 'Shrine', 'Market', 'Workshop']),
                    'effect' => $this->faker->sentence()
                ],
                [
                    'name' => $this->faker->word() . ' ' . $this->faker->randomElement(['Library', 'University', 'Monument', 'Garden', 'Theater']),
                    'replaces' => $this->faker->randomElement(['Library', 'University', 'Monument', 'Garden', 'Theater']),
                    'effect' => $this->faker->sentence()
                ]
            ]),
            'unique_units' => json_encode([
                [
                    'name' => $this->faker->word() . ' ' . $this->faker->randomElement(['Warrior', 'Archer', 'Horseman', 'Spearman', 'Swordsman']),
                    'replaces' => $this->faker->randomElement(['Warrior', 'Archer', 'Horseman', 'Spearman', 'Swordsman']),
                    'effect' => $this->faker->sentence(),
                    'ability' => $this->faker->word()
                ]
            ]),
            'city_names' => json_encode(array_map(
                fn() => $this->faker->unique()->city(),
                range(1, 5)
            )),
            'spy_names' => json_encode(array_map(
                fn() => $this->faker->unique()->firstName(),
                range(1, 3)
            )),
            'historical_info' => json_encode([
                [
                    'heading' => 'History',
                    'text' => $this->faker->paragraphs(2, true)
                ],
                [
                    'heading' => 'Geography',
                    'text' => $this->faker->paragraphs(1, true)
                ],
                [
                    'heading' => 'Legacy',
                    'text' => $this->faker->paragraphs(1, true)
                ]
            ]),
            'url' => $this->faker->url()
        ];
    }
}
