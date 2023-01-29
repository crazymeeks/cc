<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    use HasFactory;

    protected $table = 'stats';

    protected $fillable = [
        'param_id',
        'match_id',
        'team_id',
        'player_id',
        'param_name',
        'value',
    ];
}
