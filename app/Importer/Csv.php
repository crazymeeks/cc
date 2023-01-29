<?php

namespace App\Importer;

use App\Importer\Team;
use App\Importer\Player;
use App\Importer\Matches;
use App\Importer\Stat;

class Csv
{

    /**
     * Specifically import team
     *
     * @return $this
     */
    public function teamImport()
    {
        $team = new Team();
        $team->import();

        return $this;
    }

    /**
     * Specifically import player
     *
     * @return $this
     */
    public function playerImport()
    {
        $team = new Player();
        $team->import();

        return $this;
    }

    /**
     * Specifically import matches
     *
     * @return $this
     */
    public function matchesImport()
    {
        $team = new Matches();
        $team->import();
        return $this;
    }

    /**
     * Specifically import stats
     *
     * @return $this
     */
    public function statsImport()
    {
        $team = new Stat();
        $team->import();
        return $this;
    }
}