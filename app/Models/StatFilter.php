<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatFilter extends Model
{
    use HasFactory;

    protected $table = 'stat_filters';

    protected $fillable = [
        'param_id',
        'param_name'
    ];
}
