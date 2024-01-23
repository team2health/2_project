<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_email' => $this->faker->unique()->safeEmail(),
            'user_name' => $this->faker->unique()->name(),
            'user_password' => '$2y$10$3a6zpvZybCOQoaNepOIy8.YndwxyCQZid.MHxPt1ZhcNCfkG64obG',
            'birthday' => $this->faker->dateTimeBetween('1950-01-01', '2020-01-01'),
            'user_address_num' => '48060',
            'user_address' => '부산 해운대구 APEC로 30',
            'user_gender' => $this->faker->randomElement([1, 2]),
            'user_img' => '../img/default_f.png',
            'agreement_flg' => '1',
            'email_verified_at' => $this->faker->date,
            'remember_token' => Str::random(10),
            'created_at' => $this->faker->dateTimeBetween('2023-08-01', '2024-01-23'),
            'updated_at' =>$this->faker->dateTimeBetween('2023-08-01', '2024-01-23'),
        ];
    }
}
