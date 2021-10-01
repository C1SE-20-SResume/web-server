<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobDetail;

class JobDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobDetail::factory(5)->create();
    }
}
