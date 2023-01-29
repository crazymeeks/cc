<?php

namespace App\Importer;

use App\Importer\Base;
use App\Models\GameMatch;
use Illuminate\Support\Facades\DB;

class Matches extends Base
{
    public function import()
    {
        $generator = $this->readCsv();
        DB::table('match_team')->truncate();
        GameMatch::truncate();
        
        foreach($generator as $record){
            
            $values = array_filter(explode(';', $record));
            if (count($values) > 0) {
                list($matchId, $matchName, $matchDate, $team1Id, $team1Score, $team2Id, $team2Score) = $values;
                
                $exploded = explode("-", $matchDate);
                $match = GameMatch::create([
                    'match_id' => $matchId,
                    'match_name' => $matchName,
                    'match_date' => $matchDate,
                    'match_year' => $exploded[0],
                ]);

                DB::table('match_team')->insert([
                    'match_id' => $match->match_id,
                    'team1_id' => $team1Id,
                    'team2_id' => $team2Id,
                    'team1_score' => (int) $team1Score,
                    'team2_score' => (int) $team2Score,
                    'created_at' => now()->__toString(),
                    'updated_at' => now()->__toString(),
                ]);
            }


            if (is_testing()) {
                break;
            }
        }
    }

    /** @inheritDoc */
    public function getFile()
    {
        return base_path('app/Importer/_files/matches.csv');
    }
}