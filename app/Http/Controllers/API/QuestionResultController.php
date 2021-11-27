<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QuestionDetail;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

class QuestionResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maths = QuestionDetail::where('type_id', 1)->inRandomOrder()->limit(5)->get();
        $english = QuestionDetail::where('type_id', 2)->inRandomOrder()->limit(5)->get();
        $programing = QuestionDetail::where('type_id', 3)->inRandomOrder()->limit(5)->get();
        $aptitude = json_decode(json_encode([
            'maths' => $this->getOptions($maths),
            'english' => $this->getOptions($english),
            'programing' => $this->getOptions($programing),
        ]));
        // cởi mở
        $openness = QuestionDetail::where('type_id', 4)->inRandomOrder()->limit(3)->get();
        // tận tâm
        $conscientiousness = QuestionDetail::where('type_id', 5)->inRandomOrder()->limit(3)->get();
        // hướng ngoại
        $extraversion = QuestionDetail::where('type_id', 6)->inRandomOrder()->limit(3)->get();
        // dễ chịu
        $agreeableness = QuestionDetail::where('type_id', 7)->inRandomOrder()->limit(3)->get();
        // nhạy cảm
        $neuroticism = QuestionDetail::where('type_id', 8)->inRandomOrder()->limit(3)->get();
        $personality = json_decode(json_encode([
            'openness' => $this->getOptions($openness),
            'conscientiousness' => $this->getOptions($conscientiousness),
            'extraversion' => $this->getOptions($extraversion),
            'agreeableness' => $this->getOptions($agreeableness),
            'neuroticism' => $this->getOptions($neuroticism),
        ]));
        return response()->json([
            'success' => true,
            'aptitude' => $aptitude,
            'personality' => $personality,
        ]);
        //paginate(5);
    }

    /**
     *
     */
    public function getOptions($array)
    {
        $array_data = null;
        foreach($array as $item){
            $options = $item->option;
            $option_data = null;
            if($options->count() >0){
                foreach($options as $option){
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
        return($array_data);
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