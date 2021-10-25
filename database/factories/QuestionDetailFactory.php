<?php

namespace Database\Factories;

use App\Models\QuestionDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuestionDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ques_type' => $this->faker->randomElement(['math', 'english', 'programing', 
                                                        'open', 'conscientious', 'extravert', 'agreeable', 'neurotic']),
            'ques_content' => $this->faker->paragraph(3, true),
        ];
    }
}
