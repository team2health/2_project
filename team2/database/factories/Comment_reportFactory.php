<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment_report>
 */
class Comment_reportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'u_id' => $this->faker->numberBetween(1, 1000),
            'comment_id' => $this->faker->numberBetween(1, 1000),
            'comment_reason_flg' => $this->faker->numberBetween(1, 8),
            'comment_report_complete' => '0',
            'created_at' => $this->faker->dateTimeBetween('2023-08-01', '2024-01-23'),
            'updated_at' =>$this->faker->dateTimeBetween('2023-08-01', '2024-01-23'),
        ];
    }
}
