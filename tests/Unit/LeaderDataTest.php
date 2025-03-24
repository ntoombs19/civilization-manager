<?php

namespace Tests\Unit;

use App\Data\LeaderData;
use Tests\TestCase;

class LeaderDataTest extends TestCase
{
    private array $validLeaderData = [
        'id' => 1,
        'civilization_id' => 2,
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
    ];

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_be_instantiated_with_valid_data()
    {
        $leader = new LeaderData(
            id: $this->validLeaderData['id'],
            civilizationId: $this->validLeaderData['civilization_id'],
            name: $this->validLeaderData['name'],
            subtitle: $this->validLeaderData['subtitle'],
            lived: $this->validLeaderData['lived'],
            icon: $this->validLeaderData['icon'],
            trait: $this->validLeaderData['trait'],
            titles: $this->validLeaderData['titles'],
            historicalInfo: $this->validLeaderData['historical_info'],
        );

        $this->assertEquals($this->validLeaderData['id'], $leader->id);
        $this->assertEquals($this->validLeaderData['civilization_id'], $leader->civilizationId);
        $this->assertEquals($this->validLeaderData['name'], $leader->name);
        $this->assertEquals($this->validLeaderData['subtitle'], $leader->subtitle);
        $this->assertEquals($this->validLeaderData['lived'], $leader->lived);
        $this->assertEquals($this->validLeaderData['icon'], $leader->icon);
        $this->assertEquals($this->validLeaderData['trait'], $leader->trait);
        $this->assertEquals($this->validLeaderData['titles'], $leader->titles);
        $this->assertEquals($this->validLeaderData['historical_info'], $leader->historicalInfo);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_be_created_from_array_using_static_method()
    {
        $leader = LeaderData::from($this->validLeaderData);

        $this->assertEquals($this->validLeaderData['id'], $leader->id);
        $this->assertEquals($this->validLeaderData['civilization_id'], $leader->civilizationId);
        $this->assertEquals($this->validLeaderData['name'], $leader->name);
        $this->assertEquals($this->validLeaderData['subtitle'], $leader->subtitle);
        $this->assertEquals($this->validLeaderData['lived'], $leader->lived);
        $this->assertEquals($this->validLeaderData['icon'], $leader->icon);
        $this->assertEquals($this->validLeaderData['trait'], $leader->trait);
        $this->assertEquals($this->validLeaderData['titles'], $leader->titles);
        $this->assertEquals($this->validLeaderData['historical_info'], $leader->historicalInfo);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_transforms_to_database_array_correctly()
    {
        $leader = LeaderData::from($this->validLeaderData);
        $dbArray = $leader->toDatabase();

        $this->assertEquals($this->validLeaderData['civilization_id'], $dbArray['civilization_id']);
        $this->assertEquals($this->validLeaderData['name'], $dbArray['name']);
        $this->assertEquals($this->validLeaderData['subtitle'], $dbArray['subtitle']);
        $this->assertEquals($this->validLeaderData['lived'], $dbArray['lived']);
        $this->assertEquals($this->validLeaderData['icon'], $dbArray['icon']);
        $this->assertEquals($this->validLeaderData['trait'], $dbArray['trait']);
        $this->assertEquals($this->validLeaderData['titles'], $dbArray['titles']);
        $this->assertEquals($this->validLeaderData['historical_info'], $dbArray['historical_info']);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_override_civilization_id_in_to_database()
    {
        $leader = LeaderData::from($this->validLeaderData);
        $newCivId = 999;
        $dbArray = $leader->toDatabase($newCivId);

        $this->assertEquals($newCivId, $dbArray['civilization_id']);
        $this->assertNotEquals($this->validLeaderData['civilization_id'], $dbArray['civilization_id']);
    }
} 