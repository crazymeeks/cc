<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Importer\Csv;
use App\Models\Player;
use App\Models\Stat;
use App\Models\GameMatch;
use App\Models\StatFilter;

class ImportCsvTest extends TestCase
{


    public function testImportTeams()
    {
        $csv = new Csv();

        $csv->teamImport();

        $this->assertDatabaseHas('teams', [
            'team_id' => 64,
            'team_name' => 'Feyenoord',
            'team_short_name' => 'Feyenoord',
        ]);
    }


    public function testImportPlayers()
    {
        $csv = new Csv();

        $csv->playerImport();
        
        $this->assertDatabaseHas('players', [
            'player_id' => 603,
            'firstname' => 'Aleksander',
            'lastname' => 'Radosavljevic',
            'football_name' => 'Aleksandar Radosavljevic',
        ]);
    }

    public function testImportMatches()
    {

        $csv = new Csv();

        $csv->matchesImport();
        
        $this->assertDatabaseHas('match_team', [
            'match_id' => 1547,
            'team1_id' => 161,
            'team2_id' => 168,
            'team1_score' => 0,
            'team2_score' => 0,
        ]);

        $this->assertDatabaseHas('matches', [
            'match_id' => 1547,
            'match_name' => 'Twente Enschede FC - PSV',
            'match_date' => '2011-01-26 19:45',
            'match_year' => '2011',
        ]);
    }

    public function testImportStats()
    {
        
        Stat::factory()->create([
            'param_name' => 'Number of matches, including short-data information'
        ]);
        
        StatFilter::factory()->create();
        GameMatch::factory()->create([
            'match_id' => 2860
        ]);
        Player::factory()->create([
            'player_id' => 1706
        ]);


        $csv = new Csv();
        
        $csv->statsImport();
        
        $this->assertDatabaseHas('stats', [
            'param_id' => 527,
            'match_id' => 2860,
            'team_id' => 64,
            'player_id' => 1706,
            'param_name' => 'Number of matches, including short-data information',
            'value' => 1,
        ]);
    }
}