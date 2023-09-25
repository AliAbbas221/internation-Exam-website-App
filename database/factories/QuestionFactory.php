<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'content' => $this->faker->text(60), // Generate a random string of 200 characters
            'reference' => $this->faker->text(20), // Generate a random url
            'term_id' => '7', 
            'collage_id' => '3',
            'specialization_id' => function () {
                return \App\Models\Specialization::Where('collage_id','3')->inRandomOrder()->first()->id;}
        ];
    }
}
