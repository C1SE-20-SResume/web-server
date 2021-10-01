<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobKeyword;

class JobKeywordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numberOfKeyword = rand(1, 5);
        for ($i = 0; $i <= $numberOfKeyword; $i++) {
            JobKeyword::factory(1)->create();
        }
    }
}
