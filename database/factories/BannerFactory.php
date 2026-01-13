<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'subtitle' => $this->faker->sentence(6),

            'image' => 'banners/' . $this->faker->uuid . '.jpg',
            'position' => $this->faker->unique()->numberBetween(1, 100),
        ];
    }
}
