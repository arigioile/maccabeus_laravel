<?php

namespace App\Console\Commands;

use App\Models\Season;
use Illuminate\Console\Command;
use Carbon\Carbon;

class DownloadStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'volley:download-stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scarica dal sito della federazione i dati sul campionato';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now();
        $this->info('- Start job (' . $this->signature . '): ' . $now);

        // Scarico i risultati dei tornei appartenenti alla stagione in corso
        $tournaments = Season::myActiveTournaments();
        foreach ($tournaments->get() as $tournament ) {
            $this->info(' Download results for tournament ' . $tournament->name );

            // Scarico i risultati e aggiorno le classifiche
            $tournament->downloadResults();
            $tournament->updateRanking();
        }

        return Command::SUCCESS;
    }
}
