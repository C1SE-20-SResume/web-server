<?php

namespace Database\Factories;

use App\Models\QuestionOption;
use App\Models\QuestionDetail   ;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionOptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuestionOption::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ques_id' => QuestionDetail::inRandomOrder()->value('id'),
            'option_content' => $this->faker->paragraph(3, true),
        ];
    }
}
