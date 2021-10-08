<?php

namespace Database\Factories;

use App\Models\JobApply;
use App\Models\JobDetail;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobApplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobApply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->value('id'),
            'job_id' => JobDetail::inRandomOrder()->value('id'),
            'cv_file' => $this->faker->randomElement(['a.pdf', 'b.pdf', 'c.docx', 'd.docx']),
            'cv_score'=> $this->faker->numberBetween(1.0, 5.0),
            'pass_status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
