<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobDetail;
use App\Models\JobKeyword;

class JobDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = JobDetail::all();
        $data = [];
        foreach($jobs as $job) {
            $company = $job->company;
            $data[] = json_decode(json_encode([
                'id' => $job->id,
                'company_name' => $company->company_name,
                'logo_url' => $company->logo_url,
                'job_title' => $job->job_title,
                'job_place' => $job->job_place,
                'salary' => $job->salary,
                'created_at' => $job->created_at,
                'updated_at' => $job->updated_at,
            ]));
        }
        return response()->json([
            'status' => 1,
            'data' => $data,
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
        $request = $request->only('company_id', 'job_title', 'job_descrip', 'job_benefit', 'job_place', 'salary', 'job_keyword');
            if(isset($request['company_id']) && $request['salary'] >= 0 && isset($request['job_keyword'])) {
                $job_id = JobDetail::create([
                    'company_id' => $request['company_id'],
                    'job_title' => $request['job_title'],
                    'job_descrip' => $request['job_descrip'],
                    'job_benefit' => $request['job_benefit'],
                    'salary' => $request['salary'],
                    'job_place' => $request['job_place'],
                ])->id;
                $job_keyword = $request['job_keyword'];
                foreach($job_keyword as $item){
                    JobKeyword::create([
                        'job_id' => $job_id,
                        'keyword' => $item['keyword'],
                        'priority_weight' => $item['weight'],
                    ]);
                }
                return response()->json([
                    'status' => 1,
                    'data' => $job_keyword,
                ]);
            }
        return response()->json([
            'status' => 0,
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
        $job = JobDetail::where('id', $id)->first();
        if ($job->count() != 0) {
            $company = $job->company;
            $data = json_decode(json_encode([
                'id' => $job->id,
                'company_name' => $company->company_name,
                'logo_url' => $company->logo_url,
                'job_title' => $job->job_title,
                'job_descrip' => $job->job_descrip,
                'job_benefit' => $job->job_benefit,
                'job_place' => $job->job_place,
                'salary' => $job->salary,
                'created_at' => $job->created_at,
                'updated_at' => $job->updated_at,
            ]));
            return response()->json([
                'status' => 1,
                'data' => $data,
            ]);
        }
        
        return response()->json([
            'status' => 0,
        ]);
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
