<?php

namespace App\Importer;

use App\Importer\Base;
use App\Models\Team as TeamModel;

class Team extends Base
{
    public function import()
    {
        $generator = $this->readCsv();
        TeamModel::truncate();
        foreach($generator as $record){
            
            $values = array_filter(explode(';', $record));
            if (count($values) > 0) {
                list($teamId, $teamName, $teamShortName) = $values;
                $data = [
                    'team_id' => $teamId,
                    'team_name' => $teamName,
                    'team_short_name' => $teamShortName,
                ];

                TeamModel::create($data);
            }


            if (is_testing()) {
                break;
            }
        }
    }

    /** @inheritDoc */
    public function getFile()
    {
        return base_path('app/Importer/_files/teams.csv');
    }
}