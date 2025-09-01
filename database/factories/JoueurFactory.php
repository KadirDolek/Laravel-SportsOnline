<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Joueur>
 */
class JoueurFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'age' => $this->faker->numberBetween(18, 40),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'pays' => $this->faker->country(),
            'position_id' => $this->faker->numberBetween(1, 5),
            'equipe_id' => $this->faker->numberBetween(1, 8),
            'genre_id' => $this->faker->numberBetween(1, 3),
            'photo_id' => null,
            'user_id' => $this->faker->numberBetween(1, 3),
            'is_reserve' => $this->faker->boolean(20),
        ];
    }
}
