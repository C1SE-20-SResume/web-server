<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobDetail;
use App\Models\JobKeyword;
use Carbon\Carbon;

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
        $currentTime = now();
        foreach ($jobs as $job) {
            if($job->date_expire >= $currentTime->toDateTimeString()){
                $company = $job->company;
                $data[] = json_decode(json_encode([
                    'job_id' => $job->id,
                    'company_name' => $company->company_name,
                    'logo_url' => $company->logo_url,
                    'job_title' => $job->job_title,
                    'job_place' => $job->job_place,
                    'salary' => $job->salary,
                    'date_expire' => $job->date_expire,
                    'created_at' => $job->created_at,
                    'updated_at' => $job->updated_at,
                ]));
            }
        }
        return response()->json([
            'success' => true,
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
                    'success' => true,
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
        $job = JobDetail::where('id', $id)->first();
        $currentTime = now();
        if ($job->count() != 0 && $job->date_expire >= $currentTime->toDateTimeString()) {
            $company = $job->company;
            $data = json_decode(json_encode([
                'id' => $job->id,
                'company_name' => $company->company_name,
                'logo_url' => $company->logo_url,
                'job_title' => $job->job_title,
                'job_descrip' => $job->job_descrip,
                'job_require' => $job->job_require,
                'job_benefit' => $job->job_benefit,
                'job_place' => $job->job_place,
                'salary' => $job->salary,
                'date_expire' => $job->date_expire,
                'created_at' => $job->created_at,
                'updated_at' => $job->updated_at,
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($job_id)
    {
        $job = JobDetail::where('id', $job_id)->first();
        if ($job->count() != 0) { 
            $keywords = $job->keyword;
            $job_keyword = [];
            foreach($keywords as $keyword){
                $job_keyword[] = json_decode(json_encode([
                    'keyword' => $keyword->keyword,
                    'weight' => $keyword->priority_weight,
                ]));
            }
            $data[] = json_decode(json_encode([
                'id' => $job->id,
                'company_id' => $job->company->id,
                'job_title' => $job->job_title,
                'job_descrip' => $job->job_descrip,
                'job_benefit' => $job->job_benefit,
                'job_place' => $job->job_place,
                'salary' => $job->salary,
                'job_keyword' => $job_keyword,
                'created_at' => $job->created_at,
                'updated_at' => $job->updated_at,
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

    public function view($company_id)
    {
        $jobs = JobDetail::where('company_id', $company_id)->get();
        if ($jobs->count() != 0) { 
            foreach($jobs as $job) {
                $data[] = json_decode(json_encode([
                    'id' => $job->id,
                    'job_title' => $job->job_title,
                    'job_place' => $job->job_place,
                    'salary' => $job->salary,
                    'created_at' => $job->created_at,
                    'updated_at' => $job->updated_at,
                    ]));
            }
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
    public function update(Request $request, $job_id)
    {
        $request_job = $request->only('company_id', 'job_title', 'job_descrip', 'job_benefit', 'job_place', 'salary');
        $request_keyword = $request['job_keyword'];
        if(isset($request_job['company_id']) && $request_job['salary'] >=0) {
            $job = JobDetail::where('id', $job_id);
            JobKeyword::where('job_id', $job_id)->delete();
            $job->update($request_job);
            foreach($request_keyword as $keyword){
                JobKeyword::create([
                    'job_id' => $job_id,
                    'keyword' => $keyword['keyword'],
                    'priority_weight' => $keyword['weight'],
                ]);
            }
            return response()->json([
                'success' => true,
            ]);
        }
        return response()->json([
            '' => false,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($job_id)
    {
        JobDetail::destroy($job_id);
        return response()->json([
            'status' => true,
        ]);
    }
}
