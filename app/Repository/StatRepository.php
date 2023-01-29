<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;

class StatRepository
{

	protected function getQuery(string $paramName, string $matchYear)
	{
		$builder = DB::table('stats')
                     ->select(
                        'stats.id',
                        'stats.param_id',
                        'stats.param_name',
                        'players.player_id',
                        'players.firstname',
                        'players.lastname',
                        'stats.param_name',
                        'matches.match_year',
                        // 'stats.value',
                        DB::raw('SUM(stats.value) as value')
                     )
                     ->join('players', 'stats.player_id', '=', 'players.player_id')
                     ->join('matches', 'stats.match_id', '=', 'matches.match_id')
                     ->where('stats.param_name', $paramName)
                     ->where('matches.match_year', $matchYear)
                     ->groupBy('players.player_id', 'matches.match_year');
                     
        return $builder;
	}

	/**
	 * Get stats
	 * 
	 * @param  string      $paramName
	 * @param  string      $matchYear
	 * @param  int|integer $limit
	 * @param  int|integer $offset
	 * 
	 * @return array
	 */
	public function get(string $paramName, string $matchYear, int $limit = 25, int $offset = 0)
	{
		$builder = $this->getQuery($paramName, $matchYear);

        $total = $builder->count();

        $results = $this->getPerPage($paramName, $matchYear, $limit, $offset, $builder);

	    return [
	    	$total,
	    	$results,
	    ];

	}

	public function getPerPage(string $paramName, string $matchYear, int $limit, int $offset, $builder = null)
	{
		$builder = $builder ? $builder : $this->getQuery($paramName, $matchYear);
		$results = $builder->limit($limit)
                ->offset($offset)
                ->orderByRaw('SUM(stats.value) DESC')
                ->get();

        return $results;
	}
}