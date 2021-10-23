<?php

namespace Database\Factories;

use App\Models\JobDetail;
use App\Models\UserCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_id' => UserCompany::inRandomOrder()->value('id'),
            'job_title' => $this->faker->words(5, true),
            'job_descrip' => $this->faker->paragraph(3, true),
            'job_benefit' => $this->faker->paragraph(3, true),
            'salary'=> $this->faker->numberBetween(100.0, 10000.0),
            'job_place' => $this->faker->city(),
        ];
    }
}
