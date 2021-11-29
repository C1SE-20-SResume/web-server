<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QuestionDetail;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use App\Models\QuestionResult;
use Auth;

class QuestionResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check candidate have done both quizzes or not
        $user = Auth::user();
        $results = QuestionResult::select('type_id')->where('user_id', $user->id)->get();
        $types = [];
        if (count($results) > 0) {
            foreach ($results as $result) {
                $types[] = $result->type_id;
            }
        }
        if (count(array_diff([1, 2, 3, 4, 5, 6, 7, 8], $types)) == 0) {
            return response()->json([
                'success' => false,
                'message' => 'You had done both types of quizzes',
            ]);
        }
        $maths = QuestionDetail::where('type_id', 1)->inRandomOrder()->limit(5)->get();
        $english = QuestionDetail::where('type_id', 2)->inRandomOrder()->limit(5)->get();
        $programing = QuestionDetail::where('type_id', 3)->inRandomOrder()->limit(5)->get();
        $aptitude = json_decode(json_encode([
            // toán
            'maths' => $this->getOptions($maths),
            // tiếng anh
            'english' => $this->getOptions($english),
            // lập trình
            'programing' => $this->getOptions($programing),
        ]));

        $openness = QuestionDetail::where('type_id', 4)->inRandomOrder()->limit(3)->get();
        $conscientiousness = QuestionDetail::where('type_id', 5)->inRandomOrder()->limit(3)->get();
        $extraversion = QuestionDetail::where('type_id', 6)->inRandomOrder()->limit(3)->get();
        $agreeableness = QuestionDetail::where('type_id', 7)->inRandomOrder()->limit(3)->get();
        $neuroticism = QuestionDetail::where('type_id', 8)->inRandomOrder()->limit(3)->get();
        $personality = json_decode(json_encode([
            // cởi mở
            'openness' => $this->getOptions($openness),
            // tận tâm
            'conscientiousness' => $this->getOptions($conscientiousness),
            // hướng ngoại
            'extraversion' => $this->getOptions($extraversion),
            // dễ chịu
            'agreeableness' => $this->getOptions($agreeableness),
            // nhạy cảm
            'neuroticism' => $this->getOptions($neuroticism),
        ]));
        return response()->json([
            'success' => true,
            'aptitude' => $aptitude,
            'personality' => $personality,
        ]);
    }

    /**
     * Get all options of the question which is aptitude quiz
     */
    public function getOptions($array)
    {
        $array_data = null;
        foreach ($array as $item) {
            $options = $item->option;
            $option_data = null;
            if ($options->count() > 0) {
                foreach ($options as $option) {
                    $option_data[] = json_decode(json_encode([
                        'option_id' => $option->id,
                        'option_content' => $option->option_content,
                        'correct' => $option->option_correct,
                    ]));
                }
            }
            $array_data[] = json_decode(json_encode([
                'type_id' => $item->type_id,
                'ques_id' => $item->id,
                'ques_content' => $item->ques_content,
                'created_at' => $item->created_at->toDateTimeString(),
                'updated_at' => $item->updated_at->toDateTimeString(),
                'option' => $option_data,
            ]));
        }
        return ($array_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = $request->only('ques_result');
        if (isset($request['ques_result'])) {
            $user = Auth::user();
            $ques_result = $request['ques_result'];
            $ques_result = json_decode(json_encode($ques_result));
            foreach ($ques_result as $result) {
                QuestionResult::create([
                    'user_id' => $user->id,
                    'type_id' => $result->type_id,
                    'ques_score' => $result->score,
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => 'Save test quiz results successful',
                'ques_result' => $ques_result,
            ]);
        }
        return response()->json([
            'success' => false,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
