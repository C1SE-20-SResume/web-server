<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuestionType;

class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuestionType::factory(1)->create([
            'type_name' => 'maths',
        ]);
        QuestionType::factory(1)->create([
            'type_name' => 'english',
        ]);
        QuestionType::factory(1)->create([
            'type_name' => 'programing',
        ]);
        QuestionType::factory(1)->create([
            'type_name' => 'openness',
        ]);
        QuestionType::factory(1)->create([
            'type_name' => 'conscientiousness',
        ]);
        QuestionType::factory(1)->create([
            'type_name' => 'extraversion',
        ]);
        QuestionType::factory(1)->create([
            'type_name' => 'agreeableness',
        ]);
        QuestionType::factory(1)->create([
            'type_name' => 'neuroticism',
        ]);
    }
}
