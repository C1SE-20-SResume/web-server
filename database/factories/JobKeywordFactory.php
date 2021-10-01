<?php

namespace Database\Factories;

use App\Models\JobDetail;
use App\Models\JobKeyword;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobKeywordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobKeyword::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'job_id' => JobDetail::inRandomOrder()->value('id'),
            'keyword' => $this->faker->unique()->word(),
            'priority_weight'=> $this->faker->randomElement([1, 2, 3, 4, 5]),
        ];
    }
}
