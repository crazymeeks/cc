<?php

namespace App\Models;


use App\Models\Team;
use App\Models\MatchStat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameMatch extends Model
{
    use HasFactory;

    protected $table = 'matches';

    protected $fillable = [
        'match_id',
        'match_name',
        'match_date',
        'match_year',
    ];
}
