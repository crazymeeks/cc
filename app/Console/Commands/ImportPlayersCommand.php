<?php

namespace App\Console\Commands;

use App\Importer\Csv;
use Illuminate\Console\Command;

class ImportPlayersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:players';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import players';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $csv = new Csv();
        $csv->playerImport();
        return Command::SUCCESS;
    }
}
