<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobApply;
use App\Models\JobDetail;

class JobApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = JobDetail::all();
        if ($jobs != null) {
            $applies = [];
            foreach ($jobs as $job) {
                $apply = $job->apply->count();
                $company = $job->company;
                $applies[] = json_decode(json_encode([
                    'id' => $job->id,
                    'company_name' => $company->company_name,
                    'logo_url' => $company->logo_url,
                    'job_title' => $job->job_title,
                    'job_place' => $job->job_place,
                    'apply_count' => $apply,
                    'created_at' => $job->created_at,
                    'updated_at' => $job->updated_at,
                ]));
            }
            return response()->json([
                'status' => 1,
                'data' => $applies,
            ]);
        }
        return response()->json([
            'status' => 0,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($job_id)
    {
        $applies = JobApply::where('job_id', $job_id)->get();
        if ($applies->count() != 0) {
            $applies_user = [];
            $job = $applies->first()->job;
            foreach ($applies as $apply) {
                $user = $apply->user;
                $applies_user[] = json_decode(json_encode([
                    'user_id' => $user->id,
                    'full_name' => $user->full_name,
                    'gender' => $user->gender,
                    'cv_file' => $apply->cv_file,
                    'cv_score' => $apply->cv_score,
                    'pass_status' => $apply->pass_status,
                    'phone_number' => $user->phone_number,
                    'email' => $user->email,
                    'created_at' => $apply->created_at,
                    'updated_at' => $apply->updated_at,
                ]));
            }
            return response()->json([
                'status' => 1,
                'job_id' => $job_id,
                'job_title' => $job->job_title,
                'job_place' => $job->job_place,
                'data' => $applies_user,
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
