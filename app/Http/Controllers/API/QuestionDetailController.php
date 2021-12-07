<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QuestionDetail;
use App\Models\QuestionOption;
use App\Models\QuestionType;
use Auth;
use Carbon\Carbon;

class QuestionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $company_id = null;
        $company_name = null;
        $logo_url = null;
        if ($user->company != null) {
            $company_id = $user->company->id;
            $company_name = $user->company->company_name;
            $logo_url = $user->company->logo_url;
        }
        $questions = QuestionDetail::where('company_id', $company_id)->get();
        $aptitude = null;
        $personality = null;
        foreach ($questions as $question) {
            $type = $question->type;
            if (in_array($type->id, [1, 2, 3])) {
                $aptitude[] = json_decode(json_encode([
                    'ques_id' => $question->id,
                    'type_name' => $type->type_name,
                    'ques_content' => $question->ques_content,
                    'created_at' => $question->created_at->toDateTimeString(),
                    'updated_at' => $question->updated_at->toDateTimeString(),
                ]));
            } else {
                $personality[] = json_decode(json_encode([
                    'ques_id' => $question->id,
                    'type_name' => $type->type_name,
                    'ques_content' => $question->ques_content,
                    'created_at' => $question->created_at->toDateTimeString(),
                    'updated_at' => $question->updated_at->toDateTimeString(),
                ]));
            }
        }
        return response()->json([
            'success' => true,
            'company_name' => $company_name,
            'logo_url' => $logo_url,
            'aptitude' => $aptitude,
            'personality' => $personality,
        ]);
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
        $request = $request->only('type_id', 'ques_content', 'ques_option');
        if (isset($request['type_id']) && isset($request['ques_content'])) {
            $user = Auth::user();
            $company_id = null;
            if ($user->company != null) {
                $company_id = $user->company->id;
            }
            $question = QuestionDetail::create([
                'company_id' => $company_id,
                'type_id' => $request['type_id'],
                'ques_content' => $request['ques_content'],
            ]);
            // check if aptitude question then get array option
            if (in_array($request['type_id'], [1, 2, 3])) {
                $ques_option = $request['ques_option'];
                $ques_option = json_decode(json_encode($ques_option));
                foreach ($ques_option as $item) {
                    QuestionOption::create([
                        'ques_id' => $question->id,
                        'option_content' => $item->opt_content,
                        'option_correct' => $item->correct,
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Add question successful',
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
    public function edit($ques_id)
    {
        $question = QuestionDetail::where('id', $ques_id)->first();
        if ($question != null) {
            $type = $question->type;
            $options = $question->option;
            $ques_option = null;
            if ($options->count() > 0) {
                foreach ($options as $option) {
                    $ques_option[] = json_decode(json_encode([
                        'option_id' => $option->id,
                        'option_content' => $option->option_content,
                        'option_correct' => $option->option_correct,
                    ]));
                }
            }
            $data = json_decode(json_encode([
                'ques_id' => $question->id,
                'type_id' => $type->id,
                'type_name' => $type->type_name,
                'ques_content' => $question->ques_content,
                'ques_option' => $ques_option,
                'created_at' => $question->created_at->toDateTimeString(),
                'updated_at' => $question->updated_at->toDateTimeString(),
            ]));
            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        }
        return response()->json([
            'success' => false,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ques_id)
    {
        $request_ques = $request->only('type_id', 'ques_content');
        if (isset($request['type_id']) && isset($request['ques_content'])) {
            $ques = QuestionDetail::where('id', $ques_id)->first();
            $ques->update($request_ques);
            if (in_array($request['type_id'], [1, 2, 3])) {
                $options = $ques->option;
                $ques_option = $request['ques_option'];
                $ques_option = json_decode(json_encode($ques_option));
                foreach ($ques_option as $item) {
                    $updateItems[] = [
                        'option_content' => $item->opt_content,
                        'option_correct' => $item->correct,
                    ];
                }
                foreach ($options as $index => $option) {
                    $option->update($updateItems[$index]);
                }
            }
            return response()->json([
                'success' => true,
                'message' => 'Update question successful'
            ]);
        }
        return response()->json([
            'success' => false,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ques_id)
    {
        QuestionDetail::destroy($ques_id);
        return response()->json([
            'status' => true,
            'message' => 'Delete this question successful'
        ]);
    }
}