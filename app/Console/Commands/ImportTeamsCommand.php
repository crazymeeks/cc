<?php

namespace App\Console\Commands;

use App\Importer\Csv;
use Illuminate\Console\Command;

class ImportTeamsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:teams';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import teams';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $csv = new Csv();
        $csv->teamImport();
        return Command::SUCCESS;
    }
}
