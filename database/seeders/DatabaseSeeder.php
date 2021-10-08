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
            UserSeeder::class,
            JobDetailSeeder::class,
            JobKeywordSeeder::class,
            JobApplySeeder::class,
        ]);
        // composer dump-autoload before seeder database
    }
}
