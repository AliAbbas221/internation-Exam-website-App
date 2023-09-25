<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'options' => json_encode([
                'a' => $this->faker->word,
                'b' => $this->faker->word,
                'c' => $this->faker->word,
                'd' => $this->faker->word,
            ]), // Generate a JSON object with 4 options
            'is_true' => $this->faker->randomElement(['a', 'b', 'c', 'd']),
        ];
    }
}
