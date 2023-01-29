<?php

namespace App\Http\Controllers;

use App\MongoDB\Client;
use App\Models\GameMatch;
use App\Models\StatFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class PlayerMatchStatController extends Controller
{
    

    public function index(Request $request)
    {
        $viewData = [
            'matches' => GameMatch::orderBy('match_year', 'asc')->groupBy('match_year')->get(),
            'stats' => StatFilter::get(),
        ];
        
        return view('index', $viewData);

    }

    public function getData(Request $request)
    {
        
        $page = 1;
        if ($request->has('page')) {
            $page = $request->page;
        }

        $limit = 25;
        if ($request->has('limit')) {
            $limit = $request->limit;
        }

        $offset = ($page - 1) * $limit;
        $limit = $limit <= 0 ? 25 : $limit;
        
        list($total, $stats) = $this->getStats($request, $page, $limit, $offset);
        
        $pageNumbers = abs(ceil(($total/$limit)));
        $data = [
            'total' => $total,
            'pageNumbers' => $pageNumbers,
            'current_page' => $page,
            'limit' => $limit,
            'stats' => $stats,
        ];

        
        $html = view('stats', $data)->render();
        return response()->json([
            'html' => $html
        ]);
    }

    private function getStats(Request $request, int $page, int $limit, int $offset)
    {
        $filterKey = NULL;
        $cache = [];
        $total = 0;
        if ($request->has('statistic') && $request->statistic) {
            $filterKey = $request->statistic;
        }

        if ($request->has('year') && $request->year) {
            $filterKey = $filterKey ? sprintf("%s_%s", $filterKey, $request->year) : $request->year;
        }

        $cacheTotal = sprintf("%s_total", $filterKey);

        if ($request->has('page') && $request->page) {
            $filterKey = sprintf("%s_%s", $filterKey, $request->page);
        }

        if (Cache::has($filterKey)) {
            $cache = Cache::get($filterKey);
            $total = Cache::get($cacheTotal);   
        }

        return [
            $total,
            $cache
        ];
    }

    /**
     * Set total
     *
     * @param int $total
     * 
     * @return $this
     */
    private function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Set data
     *
     * @param array $stats
     * 
     * @return $this
     */
    private function setData($stats)
    {
        $this->stats = $stats;
        return $this;
    }
}
