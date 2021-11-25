<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobDetail;
use App\Models\JobKeyword;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Models\JobApply;

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
            if ($job->date_expire >= $currentTime->toDateTimeString()) {
                $company = $job->company;
                $data[] = json_decode(json_encode([
                    'job_id' => $job->id,
                    'company_name' => $company->company_name,
                    'logo_url' => $company->logo_url,
                    'job_title' => $job->job_title,
                    'job_place' => $job->job_place,
                    'salary' => $job->salary,
                    'date_expire' => $job->date_expire,
                    'created_at' => $job->created_at->toDateTimeString(),
                    'updated_at' => $job->updated_at->toDateTimeString(),
                ]));
            }
        }
        $countOfJobs = count($data);
        return response()->json([
            'success' => true,
            'countOfJobs' => $countOfJobs,
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
        $request = $request->only('job_title', 'job_descrip', 'job_require', 'job_benefit', 'job_place', 'salary', 'date_expire', 'job_keyword');
        if ($request['salary'] >= 0 && isset($request['date_expire']) && isset($request['job_keyword'])) {
            $user = Auth::user();
            $company = $user->company;
            $job = JobDetail::create([
                'company_id' => $company->id,
                'job_title' => $request['job_title'],
                'job_descrip' => $request['job_descrip'],
                'job_require' => $request['job_require'],
                'job_benefit' => $request['job_benefit'],
                'job_place' => $request['job_place'],
                'salary' => $request['salary'],
                'date_expire' => $request['date_expire'],
            ]);
            // get array job keyword
            $job_keyword = $request['job_keyword'];
            $job_keyword = json_decode($job_keyword);
            $require_score = 0;
            foreach ($job_keyword as $item) {
                // convert item to object
                if ($item->weight == 1) {
                    $require_score = $require_score + 0.3;
                } else if ($item->weight == 2) {
                    $require_score = $require_score + 0.7;
                } else if ($item->weight == 3) {
                    $require_score = $require_score + 1.15;
                } else if ($item->weight == 4) {
                    $require_score = $require_score + 1.6;
                } else if ($item->weight == 5) {
                    $require_score = $require_score + 2;
                }
                JobKeyword::create([
                    'job_id' => $job->id,
                    'keyword' => $item->keyword,
                    'priority_weight' => $item->weight,
                ]);
            }
            $job->require_score = $require_score;
            $job->save();
            return response()->json([
                'success' => true,
                'message' => 'Add job successful',
                'job' => $job_keyword,
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
        if ($job != null && $job->date_expire >= $currentTime->toDateTimeString()) {
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
                'created_at' => $job->created_at->toDateTimeString(),
                'updated_at' => $job->updated_at->toDateTimeString(),
            ]));
            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Job does not exist or has expired',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Request $request, $job_id)
    {
        $job = JobDetail::where('id', $job_id)->first();
        if ($job != null) {
            $keywords = $job->keyword;
            $job_keyword = [];
            foreach ($keywords as $keyword) {
                $job_keyword[] = json_decode(json_encode([
                    'keyword' => $keyword->keyword,
                    'weight' => $keyword->priority_weight,
                ]));
            }
            $data = json_decode(json_encode([
                'job_id' => $job->id,
                'company_id' => $job->company->id,
                'job_title' => $job->job_title,
                'job_descrip' => $job->job_descrip,
                'job_require' => $job->job_require,
                'job_benefit' => $job->job_benefit,
                'job_place' => $job->job_place,
                'salary' => $job->salary,
                'date_expire' => $job->date_expire,
                'created_at' => $job->created_at->toDateTimeString(),
                'updated_at' => $job->updated_at->toDateTimeString(),
                'job_keyword' => $job_keyword,

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

    public function view()
    {
        $user = Auth::user();
        $company = $user->company;
        $jobs = JobDetail::where('company_id', $company->id)->get();
        if ($jobs->count() != 0) {
            foreach ($jobs as $job) {
                $data[] = json_decode(json_encode([
                    'id' => $job->id,
                    'job_title' => $job->job_title,
                    'job_place' => $job->job_place,
                    'salary' => $job->salary,
                    'date_expire' => $job->date_expire,
                    'created_at' => $job->created_at->toDateTimeString(),
                    'updated_at' => $job->updated_at->toDateTimeString(),
                ]));
            }
            return response()->json([
                'success' => true,
                'company_name' => $company->company_name,
                'logo_url' => $company->logo_url,
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
        // $user = Auth::user();
        // $company = $user->company;
        $request_job = $request->only('job_title', 'job_descrip', 'job_require', 'job_benefit', 'job_place', 'salary', 'date_expire');
        $request_keyword = $request['job_keyword'];
        if (isset($request_job['date_expire']) && $request_job['salary'] >= 0) {
            $job = JobDetail::where('id', $job_id)->first();
            JobKeyword::where('job_id', $job_id)->delete();
            $job->update($request_job);
            $require_score = 0;
            foreach ($request_keyword as $keyword) {
                if ($keyword['weight'] == 1) {
                    $require_score = $require_score + 0.3;
                } else if ($keyword['weight'] == 2) {
                    $require_score = $require_score + 0.7;
                } else if ($keyword['weight'] == 3) {
                    $require_score = $require_score + 1.15;
                } else if ($keyword['weight'] == 4) {
                    $require_score = $require_score + 1.6;
                } else if ($keyword['weight'] == 5) {
                    $require_score = $require_score + 2;
                }
                JobKeyword::create([
                    'job_id' => $job_id,
                    'keyword' => $keyword['keyword'],
                    'priority_weight' => $keyword['weight'],
                ]);
            }
            $job->require_score = $require_score;
            $job->save();
            return response()->json([
                'success' => true,
                'message' => 'Update job successful'
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
    public function destroy($job_id)
    {
        $job = JobDetail::find($job_id);
        $job->date_expire = now();
        $job->save();
        return response()->json([
            'status' => true,
            'message' => 'Close this job successful'
        ]);
    }

    /**
     * Display a listing of job which had highest number of applies.
     *
     * @return \Illuminate\Http\Response
     */
    public function homepage()
    {
        $currentTime = now();
        $jobs = JobDetail::where('date_expire', '>=', $currentTime->toDateTimeString())
            ->withCount('apply')
            ->orderBy('apply_count', 'desc')
            ->limit(5)
            ->get();
        $data = [];
        foreach ($jobs as $job) {
            $company = $job->company;
            $data[] = json_decode(json_encode([
                'job_id' => $job->id,
                'company_name' => $company->company_name,
                'logo_url' => $company->logo_url,
                'job_title' => $job->job_title,
                'job_place' => $job->job_place,
                'salary' => $job->salary,
                'date_expire' => $job->date_expire,
                'created_at' => $job->created_at->toDateTimeString(),
                'updated_at' => $job->updated_at->toDateTimeString(),
            ]));
        }
        $countOfJobs = count($data);
        return response()->json([
            'success' => true,
            'countOfJobs' => $countOfJobs,
            'data' => $data,
        ]);
    }
}