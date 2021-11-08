<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobKeyword;
use App\Models\JobDetail;

class JobKeywordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = JobDetail::all();
        foreach($jobs as $job) {
            $numberOfKeyword = rand(1, 5);
            JobKeyword::factory($numberOfKeyword)->create([
                'job_id' => $job->id,
            ]);
        }
    }
}
