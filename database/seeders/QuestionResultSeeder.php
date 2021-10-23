<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuestionResult;

class QuestionResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuestionResult::factory(5)->create();
    }
}
