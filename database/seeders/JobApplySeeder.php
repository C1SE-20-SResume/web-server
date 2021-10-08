<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobApply;

class JobApplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobApply::factory(5)->create();
    }
}
