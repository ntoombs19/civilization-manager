<?php

namespace Tests\Unit;

use App\Data\CivilizationData;
use App\Data\LeaderData;
use Tests\TestCase;

class CivilizationDataTest extends TestCase
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

    private array $validCivilizationData = [
        'id' => 1,
        'name' => 'Test Civilization',
        'icon' => 'https://example.com/civ.png',
        'dawn_of_man' => 'Test dawn of man text',
        'unique_buildings' => [
            [
                'name' => 'Test Building',
                'url' => 'https://example.com/building.json'
            ]
        ],
        'unique_units' => [
            [
                'name' => 'Test Unit',
                'url' => 'https://example.com/unit.json'
            ]
        ],
        'city_names' => ['City 1', 'City 2'],
        'spy_names' => ['Spy 1', 'Spy 2'],
        'historical_info' => [
            [
                'title' => 'Test Title',
                'content' => 'Test Content'
            ]
        ],
        'url' => 'https://example.com/civilization.json'
    ];

    /**
     * Get a valid LeaderData instance for testing
     */
    private function getLeaderData(): LeaderData
    {
        return new LeaderData(
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
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_be_instantiated_with_valid_data()
    {
        $leaderData = $this->getLeaderData();
        
        $civilization = new CivilizationData(
            id: $this->validCivilizationData['id'],
            name: $this->validCivilizationData['name'],
            icon: $this->validCivilizationData['icon'],
            dawnOfMan: $this->validCivilizationData['dawn_of_man'],
            uniqueBuildings: $this->validCivilizationData['unique_buildings'],
            uniqueUnits: $this->validCivilizationData['unique_units'],
            cityNames: $this->validCivilizationData['city_names'],
            spyNames: $this->validCivilizationData['spy_names'],
            historicalInfo: $this->validCivilizationData['historical_info'],
            url: $this->validCivilizationData['url'],
            leader: $leaderData
        );

        $this->assertEquals($this->validCivilizationData['id'], $civilization->id);
        $this->assertEquals($this->validCivilizationData['name'], $civilization->name);
        $this->assertEquals($this->validCivilizationData['icon'], $civilization->icon);
        $this->assertEquals($this->validCivilizationData['dawn_of_man'], $civilization->dawnOfMan);
        $this->assertEquals($this->validCivilizationData['unique_buildings'], $civilization->uniqueBuildings);
        $this->assertEquals($this->validCivilizationData['unique_units'], $civilization->uniqueUnits);
        $this->assertEquals($this->validCivilizationData['city_names'], $civilization->cityNames);
        $this->assertEquals($this->validCivilizationData['spy_names'], $civilization->spyNames);
        $this->assertEquals($this->validCivilizationData['historical_info'], $civilization->historicalInfo);
        $this->assertEquals($this->validCivilizationData['url'], $civilization->url);
        $this->assertInstanceOf(LeaderData::class, $civilization->leader);
        $this->assertEquals($leaderData, $civilization->leader);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_be_created_from_array_using_static_method()
    {
        $combinedData = array_merge(
            $this->validCivilizationData, 
            ['leader' => $this->getLeaderData()]
        );
        
        $civilization = CivilizationData::from($combinedData);

        $this->assertEquals($this->validCivilizationData['id'], $civilization->id);
        $this->assertEquals($this->validCivilizationData['name'], $civilization->name);
        $this->assertEquals($this->validCivilizationData['icon'], $civilization->icon);
        $this->assertEquals($this->validCivilizationData['dawn_of_man'], $civilization->dawnOfMan);
        $this->assertEquals($this->validCivilizationData['unique_buildings'], $civilization->uniqueBuildings);
        $this->assertEquals($this->validCivilizationData['unique_units'], $civilization->uniqueUnits);
        $this->assertEquals($this->validCivilizationData['city_names'], $civilization->cityNames);
        $this->assertEquals($this->validCivilizationData['spy_names'], $civilization->spyNames);
        $this->assertEquals($this->validCivilizationData['historical_info'], $civilization->historicalInfo);
        $this->assertEquals($this->validCivilizationData['url'], $civilization->url);
        $this->assertInstanceOf(LeaderData::class, $civilization->leader);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_transforms_to_database_array_correctly()
    {
        $combinedData = array_merge(
            $this->validCivilizationData, 
            ['leader' => $this->getLeaderData()]
        );
        
        $civilization = CivilizationData::from($combinedData);
        $dbArray = $civilization->toDatabase();

        $this->assertEquals($this->validCivilizationData['name'], $dbArray['name']);
        $this->assertEquals($this->validCivilizationData['icon'], $dbArray['icon']);
        $this->assertEquals($this->validCivilizationData['dawn_of_man'], $dbArray['dawn_of_man']);
        $this->assertEquals($this->validCivilizationData['unique_buildings'], $dbArray['unique_buildings']);
        $this->assertEquals($this->validCivilizationData['unique_units'], $dbArray['unique_units']);
        $this->assertEquals($this->validCivilizationData['city_names'], $dbArray['city_names']);
        $this->assertEquals($this->validCivilizationData['spy_names'], $dbArray['spy_names']);
        $this->assertEquals($this->validCivilizationData['historical_info'], $dbArray['historical_info']);
        $this->assertEquals($this->validCivilizationData['url'], $dbArray['url']);
        
        // Ensure leader is not included in the database array
        $this->assertArrayNotHasKey('leader', $dbArray);
        $this->assertArrayNotHasKey('id', $dbArray);
    }
} 