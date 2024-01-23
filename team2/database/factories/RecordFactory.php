<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Record>
 */
class RecordFactory extends Factory
{
    /**
     * Define the model's default state.
     * 
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'u_id' => $this->faker->numberBetween(1, 1000),
            'part_symptom_id' => $this->faker->numberBetween(1, 148),
            'created_at' => $this->faker->dateTimeBetween('2024-01-01', '2024-01-23'),
            'updated_at' =>$this->faker->dateTimeBetween('2024-01-01', '2024-01-23'),
        ];
    }
}