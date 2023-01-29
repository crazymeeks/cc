<?php

namespace App\Importer;

use App\Importer\Base;
use App\Models\Player as PlayerModel;

class Player extends Base
{
    public function import()
    {
        $generator = $this->readCsv();
        PlayerModel::truncate();
        foreach($generator as $record){
            
            $values = array_filter(explode(';', $record));
            
            if (count($values) > 0) {
                list($teamId, $firstname, $lastname, $footballName) = $values;
                $data = [
                    'player_id' => $teamId,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'football_name' => $footballName,
                ];
                PlayerModel::create($data);
            }


            if (is_testing()) {
                break;
            }
        }
    }

    /** @inheritDoc */
    public function getFile()
    {
        return base_path('app/Importer/_files/players.csv');
    }
}