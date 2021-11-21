<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\JobDetail;
use App\Models\UserCompany;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /** 
     * Get list job from job_detail table
     * 
     * @return \Illuminate\Http\Response
     */
    public function listJob(Request $request)
    {
        // only Admin can access this function
        if (!$request->user()->isAdmin()) {
            return response()->json([
                'message' => 'You are not admin'
            ], 403);
        } else {
            $list_job = JobDetail::all();
            foreach ($list_job as $job) {
                $company_id = $job->company_id;
                $company = UserCompany::where('id', $company_id)->first();
                $job->company_name = $company->company_name;
                $job->logo = $company->logo_url;
            }
            $count = $list_job->count();
            return response()->json([
                'message' => 'Success',
                'data' => $list_job,
                'count' => $count
            ], 200);
        }
    }
    /**
     * List user from user table
     * only Admin can access this function
     */
    public function listUser(Request $request)
    {
        if (!$request->user()->isAdmin()) {
            return response()->json([
                'message' => 'You are not admin'
            ], 403);
        } else {
            $list_user = User::all();
            $count = $list_user->count();
            return response()->json([
                'message' => 'Success',
                'data' => $list_user,
                'count' => $count
            ], 200);
        }
    }
}