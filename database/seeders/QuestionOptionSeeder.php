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
        $ques_id = QuestionDetail::whereIn('ques_type', array('math', 'english', 'programing'))->get();
        foreach($ques_id as $item) {
            QuestionOption::factory(4)->create([
                'ques_id' => $item->id,
            ]);
        }
    }
}
