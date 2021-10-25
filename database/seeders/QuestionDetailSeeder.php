<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuestionDetail;

class QuestionDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuestionDetail::factory(10)->create();
    }
}
