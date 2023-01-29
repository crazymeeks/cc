<?php

namespace App\Console\Commands;

use App\Importer\Csv;
use App\Models\Team;
use App\Models\Player;
use App\Models\GameMatch;
use Illuminate\Console\Command;

class ImportStatsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import match stats';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $players = Player::count();
        $teams = Team::count();
        $matches = GameMatch::count();

        if ($players > 0 && $teams > 0 && $matches > 0) {
            $csv = new Csv();
            $csv->statsImport();
            return Command::SUCCESS;
        } else {
            $commands = [
                'php artisan import:teams',
                'php artisan import:players',
                'php artisan import:matches',
            ];
            $this->error(sprintf("Please make sure to run these commands %s first before importing stats.", implode('|', $commands)));
        }

    }
}
