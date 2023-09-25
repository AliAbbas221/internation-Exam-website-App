<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $question_ids = \App\Models\Question::all()->pluck('id');

        foreach ($question_ids as $question_id) {
            \App\Models\Answer::factory()->create(['question_id' => $question_id]); // This will create an answer for each question
        }
    }
}