<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuestionOption;
use App\Models\QuestionDetail;

class QuestionOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ques_id = QuestionDetail::whereIn('type_id', array(1, 2, 3))->get();
        foreach($ques_id as $item) {
            QuestionOption::factory(3)->create([
                'ques_id' => $item->id,
                'option_correct' => 0,
            ]);
            QuestionOption::factory(1)->create([
                'ques_id' => $item->id,
                'option_correct' => 1,
            ]);
        }
    }
}
