<?php

namespace Database\Factories;

use App\Models\QuestionType;
use App\Models\QuestionDetail;
use App\Models\UserCompany;
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
            'company_id' => UserCompany::inRandomOrder()->value('id'),
            'type_id' => QuestionType::inRandomOrder()->value('id'),
            'ques_content' => $this->faker->paragraph(1, true),
        ];
    }
}
