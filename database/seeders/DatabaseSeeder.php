<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserCompanySeeder::class,
            UserSeeder::class,
            JobDetailSeeder::class,
            JobKeywordSeeder::class,
            JobApplySeeder::class,
            QuestionDetailSeeder::class,
            QuestionOptionSeeder::class,
            QuestionResultSeeder::class,
        ]);
        // composer dump-autoload before seeder database
    }
}
