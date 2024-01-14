<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Board>
 */
class BoardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'u_id' => $this->faker->numberBetween(1, 31),
            'category_id' => $this->faker->numberBetween(1, 4),
            'board_title' => $this->faker->realText(10, 2),
            'board_content' => $this->faker->realText(50, 2),
            'board_hits' => $this->faker->randomNumber(3),
            'created_at' => $this->faker->date,
            'updated_at' =>$this->faker->date,
        ];
    }
}
