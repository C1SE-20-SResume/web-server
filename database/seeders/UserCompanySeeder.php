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
            'company_name' => 'FPT Software',
            'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/11/FPT_logo_2010.svg/1200px-FPT_logo_2010.svg.png',
        ]);
        UserCompany::factory(2)->create();
    }
}
