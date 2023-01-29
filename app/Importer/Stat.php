<?php

namespace App\Importer;

use Exception;
use App\Importer\Base;
use App\Models\GameMatch;
use App\Models\StatFilter;
use App\Repository\StatRepository;
use App\Models\Stat as StatModel;
use Illuminate\Support\Facades\Cache;



class Stat extends Base
{

    protected $rowCount = 0;
    protected $chunk = [];
    protected $statFilters = [];

    public function import()
    {
        $generator = $this->readCsv();

        if (!is_testing()) {
            StatModel::truncate();
            StatFilter::truncate();
        }

        $repository = app(StatRepository::class);

        $paramNames = [];
        
        foreach($generator as $record){
            
            $values = array_filter(explode(';', $record));
            
            if (count($values) > 0) {

                $data = $this->getData($values);
                if (!in_array($data['param_name'], $paramNames)) {
                    $this->statFilters[] = [
                        'param_id' => $data['param_id'],
                        'param_name' => $data['param_name'],
                    ];
                }

                $paramNames[] = $data['param_name'];
                $paramNames = array_unique($paramNames);

                if ($this->rowCount <= 200) {

                    $this->chunk[] = $data;
                    if (is_testing()) {
                        
                        $this->createCache($repository);
                    }
                    $this->rowCount++;
                } else {

                    $this->chunk[] = $data;
                    StatModel::insert($this->chunk);
                    $this->rowCount = 0;
                    $this->chunk = [];
                }
            }
            if (is_testing()) {
                break;
            }
        }

        if (count($paramNames) > 0 && !is_testing()) {
            StatFilter::insert($this->statFilters);
        }
        
        $this->createCache($repository);
    }

    private function createCache(StatRepository $repository)
    {
        $limit = 25;
        $matches = GameMatch::groupBy('match_year')->pluck('match_year')->toArray();
        $filters = StatFilter::get();
        foreach($filters as $filter){
            foreach($matches as $matchYear){
                $stats = $repository->get($filter->param_name, $matchYear);

                $cacheKey = sprintf("%s_%s", $filter->param_id, $matchYear);
                
                list($total, $results) = $stats;
                $cacheTotal = sprintf("%s_total", $cacheKey);

                $page1 = sprintf("%s_1", $cacheKey);
                Cache::put($page1, $results);
                Cache::put($cacheTotal, $total);

                if ($total > $limit) {
                    $page2 = 1;
                    // cache the next pages if ever
                    for($a = $limit; $a <= $total; $a *= 2){
                        $offset = $limit * $page2;
                        $stats = $repository->getPerPage($filter->param_name, $matchYear, $limit, $offset);
                        $pageCacheKey = sprintf("%s_%d", $cacheKey, ($page2 + 1));
                        Cache::put($pageCacheKey, $stats);
                        $page2++;
                    }
                }
            }
        }

    }

    private function getData(array $values)
    {
        list($matchId, $teamId, $playerId, $statId, $statName, $statValue) = $values;

        $data = [
            'param_id' => $statId,
            'match_id' => $matchId,
            'team_id' => $teamId,
            'player_id' => $playerId,
            'param_name' => str_replace('"', "", $statName),
            'value' => (float) $statValue,
            'created_at' => now()->__toString(),
            'updated_at' => now()->__toString(),
        ];
        return $data;
    }

    /** @inheritDoc */
    public function getFile()
    {
        return base_path('app/Importer/_files/match_stats.csv');
    }
}