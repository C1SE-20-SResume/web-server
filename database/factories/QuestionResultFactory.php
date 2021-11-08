<?php

namespace Database\Factories;

use App\Models\QuestionResult;
use App\Models\User;
use App\Models\QuestionDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionResultFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuestionResult::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'user_id' => User::inRandomOrder()->value('id'),
            // 'type_id' => QuestionDetail::inRandomOrder()->value('id'),
            'ques_score'=> $this->faker->numberBetween(1, 5),
        ];
    }
}
