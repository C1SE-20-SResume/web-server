<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create([
            'email' => 'recruiter@example.org',
            'role_level' => 1,
            'company_id' => 1,
            'api_token' => 'ygcz4HbaTiOLQyAHw8HxO0HI920u6UPiC4VhGn8H1c2jiMCcgLlcHC9pzbKn',
        ]);
        User::factory(1)->create([
            'email' => 'recruiter1@example.org',
            'role_level' => 1,
            'company_id' => 2,
        ]);
        User::factory(1)->create([
            'email' => 'candidate@example.org',
            'role_level' => 0,
        ]);
        User::factory(2)->create();
    }
}
