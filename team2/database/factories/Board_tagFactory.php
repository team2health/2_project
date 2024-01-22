<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Board_tag>
 */
class Board_tagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'board_id' => $this->faker->numberBetween(1, 5550),
            'hashtag_id' => $this->faker->numberBetween(1, 25),
        ];
    }
}
