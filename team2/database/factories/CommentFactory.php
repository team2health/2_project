<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'u_id' => $this->faker->numberBetween(1, 500),
            'board_id' => $this->faker->numberBetween(1, 2000),
            'comment_content' => $this->faker->realText(100, 2),
            'created_at' => $this->faker->dateTimeBetween('2023-01-01', '2024-01-16'),
            'updated_at' =>$this->faker->dateTimeBetween('2023-01-01', '2024-01-16'),
        ];
    }
}