<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserCompany;

class UserCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserCompany::factory(1)->create([
            'company_name' => 'none',
            'logo_url' => 'none',
        ]);
        UserCompany::factory(3)->create();
    }
}
