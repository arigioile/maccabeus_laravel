<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Tournament extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class)
            ->using(Ranking::class)
            ->withPivot([
                "score",
                "match_won",
                "match_lost",
                "set_won",
                "set_lost",
            ]);
    }

    public function ranking()
    {
        return $this->teams()
            ->orderByPivot('score', 'desc')
            ->orderByPivot('match_won', 'desc')
            ->orderByPivot('set_won', 'desc')
            ->orderByPivot('set_lost', 'asc')
            ->orderBy('name')
            ;
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function rounds()
    {
        return $this->results->groupBy('round');
    }

    /**
     * Ricalcola la classifica del torneo
     */
    public function updateRanking()
    {
        foreach ($this->teams as $team) {
            $score = $team->results->where('tournament_id', $this->id)->sum('pivot.score');
            $setWon = $team->results->where('tournament_id', $this->id)->sum('pivot.set_won');
            $setLost = $team->results->where('tournament_id', $this->id)->sum('pivot.set_lost');
            $matchWon = $team->results->where('tournament_id', $this->id)->sum('pivot.winner');
            $matchLost = $team->results->where('tournament_id', $this->id)->sum('pivot.loser');

            $this->teams()->syncWithoutDetaching([
                $team->id => [
                    "score" => $score,
                    "match_won" => $matchWon,
                    "match_lost" => $matchLost,
                    "set_won" => $setWon,
                    "set_lost" => $setLost,
                ]
            ]);
        }
    }


    /**
     * Riporta il numero di giornate disputate nel torneo
     *
     * @return integer
     */
    public function matchDone()
    {
        $max = 0;
        foreach ($this->ranking as $team) {
            // TODO: Valutare se è il metdo giusto
            $max = max($max, $team->pivot->match_won + $team->pivot->match_lost);
        }
        return $max;
    }

    public function downloadResults()
    {
        $parser = new CPVolleyParser();

        // Loop tutti gli incontri del campionato
        $totRounds = $this->results->max('round');
        if (!$totRounds) return;

        $url = $this->query;
        for ($round = 1; $round <= $totRounds; $round++) {
            Log::info('Parser: Download risultati giornata ' . $round);
            // $url = 'https://www.cpvolley.it/faenza-lugo-ravenna/campionato/2186/{round}/open-misto-girone-a';
            $filled_url = str_replace("{round}", $round, $url);

            // Lista degli incontri di una giornata
            $htmlText = file_get_contents($filled_url);
            $list = $parser->parseResultMatches($htmlText);
            if ($list) {
                foreach ($list as $item) {
                    $homeTeam = $this->teams()->firstOrCreate([
                        'name' =>  $item['team'][0],
                    ]);
                    $visitorTeam = $this->teams()->firstOrCreate([
                        'name' =>  $item['team'][1],
                    ]);

                    $result = Result::firstOrCreate([
                        'tournament_id' => $this->id,
                        'home_team_id' => $homeTeam->id,
                        'visitor_team_id' => $visitorTeam->id,
                        'round' => $round,
                    ]);

                    $result->teams()->sync([
                        $homeTeam->id => [
                            'set_won' => $item['set_won'][0],
                            'set_lost' => $item['set_lost'][0],
                            'score' => $item['score'][0],
                            'set_1' => $item['set_1'][0],
                            'set_2' => $item['set_2'][0],
                            'set_3' => $item['set_3'][0],
                            'set_4' => $item['set_4'][0],
                            'set_5' => $item['set_5'][0],
                            'winner' => $item['winner'][0],
                            'loser' => $item['winner'][1],
                        ],
                        $visitorTeam->id => [
                            'set_won' => $item['set_won'][1],
                            'set_lost' => $item['set_lost'][1],
                            'score' => $item['score'][1],
                            'set_1' => $item['set_1'][1],
                            'set_2' => $item['set_2'][1],
                            'set_3' => $item['set_3'][1],
                            'set_4' => $item['set_4'][1],
                            'set_5' => $item['set_5'][1],
                            'winner' => $item['winner'][1],
                            'loser' => $item['winner'][0],
                        ],
                    ]);
                }
            }
        }
    }
}
