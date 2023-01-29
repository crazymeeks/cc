<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GameMatch>
 */
class GameMatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'match_id' => 2860,
            'match_name' => 'Twente Enschede FC - PSV',
            'match_date' => '2011-01-26 19:45',
            'match_year' => '2011',
        ];
    }
}
