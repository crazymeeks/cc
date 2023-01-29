<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MatchStat>
 */
class StatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'param_id' => 527,
            'param_name' => 'Shot / on target',
            'value' => 1,
            'match_id' => 2860,
            'team_id' => 64,
            'player_id' => 1706,
        ];
    }
}
