<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Models\Stat;
use App\Models\Team;
use App\Models\Player;
use App\Importer\Csv;
use App\MongoDB\Client;
use App\Models\GameMatch;
use Illuminate\Support\Facades\DB;


class PlayerMatchStatControllerTest extends TestCase
{

    protected $mongodb;

    public function setUp(): void
    {
        parent::setUp();
        $client = new Client();
        $this->mongodb = $client->createConnection();

        $this->seedData();
    }

    public function testShouldGetPlayerStatWithoutFilter()
    {
        $response = $this->json('GET', route('web.get.data'));
        dd($response->original);
        $this->assertTrue(str_contains($response->original['html'], 'Leroy Johan Fer'));
    }


    private function seedData()
    {

        $this->mongodb->stats->insertMany([
            [
                'param_id' => 527,
                'match_id' => 2860,
                'team_id' => 64,
                'player_id' => 1706,
                'param_name' => 'Number of matches, including short-data information',
                'value' => 1,
                'created_at' => now()->__toString(),
                'updated_at' => now()->__toString(),
            ],
            [
                'param_id' => 527,
                'match_id' => 2860,
                'team_id' => 64,
                'player_id' => 1707,
                'param_name' => 'Number of matches, including short-data information',
                'value' => 2,
                'created_at' => now()->__toString(),
                'updated_at' => now()->__toString(),
            ]
        ]);

        // $this->mongodb->players->insertMany([
        //     [
        //         'player_id' => 1706,
        //         'firstname' => 'Aleksander',
        //         'lastname' => 'Usyk',
        //         'football_name' => 'AU',
        //     ],
        //     [
        //         'player_id' => 1707,
        //         'firstname' => 'Alex',
        //         'lastname' => 'Usx',
        //         'football_name' => 'UA',
        //     ]
        // ]);

        // $this->mongodb->teams->insertMany([
        //     [
        //         'team_id' => 64,
        //         'team_name' => 'Feyenoord',
        //         'team_short_name' => 'Feyenoord',
        //     ],
        //     [
        //         'team_id' => 69,
        //         'team_name' => 'TS',
        //         'team_short_name' => 'TS',
        //     ]
        // ]);

        // $this->mongodb->matches->insertOne([
        //     'match_id' => 2860,
        //     'team1_id' => 64,
        //     'team2_id' => 69,
        //     'match_name' => 'Twente Enschede FC - PSV',
        //     'match_date' => '2011-01-26 19:45',
        //     'match_year' => '2011',
        //     'team1_score' => 0,
        //     'team2_score' => 0,
        // ]);
        
        $this->createTeam1Players();
        $this->createTeam2Players();

        GameMatch::factory()->create([
            'match_id' => 2860,
            'match_name' => 'Feyenoord - PSV',
            'match_date' => '2011-04-24 12:30',
            'match_year' => '2011',
        ]);
        GameMatch::factory()->create([
            'match_id' => 5202,
            'match_name' => 'Feyenoord - Roda JC Kerkrade',
            'match_date' => '2011-08-13 19:45',
            'match_year' => '2011',
        ]);

        GameMatch::factory()->create([
            'match_id' => 5239,
            'match_name' => 'Feyenoord - De Graafschap',
            'match_date' => '2011-09-17 19:45',
            'match_year' => '2011',
        ]);

        $this->createTeam1Stat();
        $this->createTeam2Stat();


        DB::table('match_team')->insert([
            [
                'match_id' => 2860,
                'team1_id' => 64,
                'team2_id' => 69,
                'team1_score' => 2,
                'team2_score' => 1,
            ],
            [
                'match_id' => 5202,
                'team1_id' => 64,
                'team2_id' => 69,
                'team1_score' => 2,
                'team2_score' => 1,
            ]
        ]);
    }

    private function createTeam1Stat()
    {

        Stat::factory()->create([
            'param_id' => 527,
            'param_name' => 'Number of matches, including short-data information',
            'player_id' => 1706,
            'match_id' => 2860,
            'team_id' => 64,
            'value' => 0,
        ]);


        Stat::factory()->create([
            'param_id' => 527,
            'param_name' => 'Number of matches, including short-data information',
            'player_id' => 1712,
            'match_id' => 2860,
            'team_id' => 64,
            'value' => 1,
        ]);

        Stat::factory()->create([
            'param_id' => 527,
            'param_name' => 'Number of matches, including short-data information',
            'player_id' => 4321,
            'match_id' => 2860,
            'team_id' => 64,
            'value' => 1,
        ]);

        Stat::factory()->create([
            'param_id' => 527,
            'param_name' => 'Number of matches, including short-data information',
            'player_id' => 1706,
            'match_id' => 5202,
            'team_id' => 64,
            'value' => 0,
        ]);

        Stat::factory()->create([
            'param_id' => 527,
            'param_name' => 'Number of matches, including short-data information',
            'player_id' => 1712,
            'match_id' => 5202,
            'team_id' => 64,
            'value' => 1,
        ]);

        Stat::factory()->create([
            'param_id' => 963,
            'param_name' => 'xG',
            'player_id' => 4321,
            'match_id' => 5202,
            'team_id' => 64,
            'value' => 1,
        ]);
    }

    private function createTeam2Stat()
    {

        Stat::factory()->create([
            'param_id' => 527,
            'param_name' => 'Number of matches, including short-data information',
            'player_id' => 1238522,
            'match_id' => 2860,
            'team_id' => 69,
            'value' => 0,
        ]);

        Stat::factory()->create([
            'param_id' => 527,
            'param_name' => 'Number of matches, including short-data information',
            'player_id' => 9817,
            'match_id' => 2860,
            'team_id' => 69,
            'value' => 1,
        ]);

        Stat::factory()->create([
            'param_id' => 963,
            'param_name' => 'xG',
            'player_id' => 15124,
            'match_id' => 2860,
            'team_id' => 69,
            'value' => 1,
        ]);

        Stat::factory()->create([
            'param_id' => 527,
            'param_name' => 'Number of matches, including short-data information',
            'player_id' => 1238522,
            'match_id' => 5202,
            'team_id' => 69,
            'value' => 0,
        ]);

        Stat::factory()->create([
            'param_id' => 527,
            'param_name' => 'Number of matches, including short-data information',
            'player_id' => 9817,
            'match_id' => 5202,
            'team_id' => 69,
            'value' => 1,
        ]);

        Stat::factory()->create([
            'param_id' => 963,
            'param_name' => 'xG',
            'player_id' => 15124,
            'match_id' => 5202,
            'team_id' => 69,
            'value' => 1,
        ]);
    }

    private function createTeam1Players()
    {
        Team::factory()->create([
            'team_id' => 64,
            'team_name' => 'Feyenoord',
            'team_short_name' => 'Feyenoord',
        ]);

        Player::factory()->create([
            'player_id' => 1706,
            'firstname' => 'Rob',
            'lastname' => 'van Dijk',
            'football_name' => '\N',
        ]);
        
        Player::factory()->create([
            'player_id' => 1712,
            'firstname' => 'Leroy Johan',
            'lastname' => 'Fer',
            'football_name' => 'Leroy Fer',
        ]);

        Player::factory()->create([
            'player_id' => 4321,
            'firstname' => 'Diego Marvin',
            'lastname' => 'Biseswar',
            'football_name' => 'Diego Biseswar',
        ]);
    }

    private function createTeam2Players()
    {
        Team::factory()->create([
            'team_id' => 69,
            'team_name' => 'NEC',
            'team_short_name' => 'NEC',
        ]);

        Player::factory()->create([
            'player_id' => 1238522,
            'firstname' => 'MaryKate',
            'lastname' => 'VanDyke',
            'football_name' => '\N',
        ]);
        
        Player::factory()->create([
            'player_id' => 9817,
            'firstname' => 'Wojciech',
            'lastname' => 'Golla',
            'football_name' => 'Wojciech Golla',
        ]);

        Player::factory()->create([
            'player_id' => 15124,
            'firstname' => 'Dario',
            'lastname' => 'Dumic',
            'football_name' => 'Dario Dumic',
        ]);
    }
}