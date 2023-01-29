<?php

namespace App\Console\Commands;

use App\Importer\Csv;
use Illuminate\Console\Command;

class ImportMatchesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:matches';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import matches';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $csv = new Csv();
        $csv->matchesImport();
        return Command::SUCCESS;
    }
}
