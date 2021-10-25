<?php

namespace Database\Factories;

use App\Models\UserCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserCompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserCompany::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_name' => $this->faker->words(3, true),
            'logo_url' => $this->faker->imageUrl(800, 600),
        ];
    }
}
