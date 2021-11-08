<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuestionResult;
use App\Models\QuestionType;

class QuestionResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_id = rand(3, 5);
        $types = QuestionType::all();
        foreach($types as $type) {
            QuestionResult::factory(1)->create([
                'user_id' => $user_id,
                'type_id' => $type->id,
            ]);
        }
    }
}
