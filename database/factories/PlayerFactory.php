<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'player_id' => 603,
            'firstname' => 'Aleksander',
            'lastname' => 'Radosavljevic',
            'football_name' => 'Aleksandar Radosavljevic',
        ];
    }
}
