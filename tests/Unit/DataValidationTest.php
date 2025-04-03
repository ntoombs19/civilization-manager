<?php

namespace Tests\Unit;

use App\Data\CivilizationData;
use App\Data\LeaderData;
use Spatie\LaravelData\Exceptions\CannotCreateData;
use Tests\TestCase;

class DataValidationTest extends TestCase
{
    /**
     * Test leader data validation for required fields
     */
    #[\PHPUnit\Framework\Attributes\Test]
    public function leader_data_requires_id_and_civilization_id()
    {
        $this->expectException(CannotCreateData::class);
        $this->expectExceptionMessage('Parameters missing: id, civilizationId');

        // Missing id and civilization_id
        LeaderData::from([
            'name' => 'Test Leader',
            'subtitle' => 'Leader of Tests',
            'lived' => '1900 - 2000',
            'icon' => 'https://example.com/leader.png',
            'trait' => [
                'name' => 'Test Trait',
                'effect' => 'Test Effect'
            ],
            'titles' => ['Title 1', 'Title 2'],
            'historical_info' => [
                [
                    'heading' => 'Test Heading',
                    'text' => 'Test Historical Text'
                ]
            ]
        ]);
    }

    /**
     * Test leader data validation for required name
     */
    #[\PHPUnit\Framework\Attributes\Test]
    public function leader_data_requires_name()
    {
        $this->expectException(CannotCreateData::class);
        $this->expectExceptionMessage('Parameters missing: name');

        // Missing name
        LeaderData::from([
            'id' => 1,
            'civilization_id' => 2,
            'subtitle' => 'Leader of Tests',
            'lived' => '1900 - 2000',
            'icon' => 'https://example.com/leader.png',
            'trait' => [
                'name' => 'Test Trait',
                'effect' => 'Test Effect'
            ],
            'titles' => ['Title 1', 'Title 2'],
            'historical_info' => [
                [
                    'heading' => 'Test Heading',
                    'text' => 'Test Historical Text'
                ]
            ]
        ]);
    }

    /**
     * Test civilization data validation for required leader
     */
    #[\PHPUnit\Framework\Attributes\Test]
    public function civilization_data_requires_leader()
    {
        $this->expectException(CannotCreateData::class);
        $this->expectExceptionMessage('Parameters missing: leader');

        // Missing leader
        CivilizationData::from([
            'id' => 1,
            'name' => 'Test Civilization',
            'icon' => 'https://example.com/civ.png',
            'dawn_of_man' => 'Test dawn of man text',
            'historical_info' => [
                [
                    'title' => 'Test Title',
                    'content' => 'Test Content'
                ]
            ],
        ]);
    }
}
