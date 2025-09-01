<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipe>
 */
class EquipeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nom' => $this->faker->unique()->company(),
            'ville' => $this->faker->city(),
            'pays' => $this->faker->country(),
            'continent_id' => $this->faker->numberBetween(1, 6),
            'genre_id' => $this->faker->numberBetween(1, 3),
            'user_id' => $this->faker->numberBetween(1, 3)
        ];
    }
}
