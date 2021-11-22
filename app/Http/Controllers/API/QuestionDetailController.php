<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QuestionDetail;
use App\Models\QuestionOption;
use Auth;

class QuestionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            if($user->company !=null) {
                $company_id = $user->company->id;
            }
            $question = QuestionDetail::create([
                'company_id' => $company_id,
                'type_id' => $request['type_id'],
                'ques_content' => $request['ques_content'],
            ]);
            // check if apptitude question then get array option
            if(in_array($request['type_id'], [1,2,3])) {
                $ques_option = $request['ques_option'];
                $ques_option = json_decode($ques_option);
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
                'option' => $ques_option,
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
