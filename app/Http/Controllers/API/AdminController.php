<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobDetail;
use App\Models\UserCompany;
use App\Models\User;
use App\Models\JobApply;
use Auth;
use Carbon\Carbon;
use App\Models\QuestionDetail;

class AdminController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     // only admin can access this controller
    //     $this->middleware('auth:api');
    //     // check if user is admin
    //     $this->middleware('admin:api');
    // }

    public function loginAdmin(Request $request)
    {
        // check if isAdmin
        $user = User::where('email', $request->email)->first();

        if ($user->isAdmin() && Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            $api_token = Str::random(60);
            $user->api_token = $api_token;
            $user->save();
            return response()->json([
                'message' => 'Admin login successfully',
                'api_token' => $api_token,
            ], 200);
        } else {
            return response()->json([
                'message' => 'You are not admin'
            ], 401);
        }
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
            $list_user = User::whereIn('role_level', [0, 1])->get();
            $candidate = [];
            $recruiter = [];
            foreach ($list_user as $user) {
                if ($user->role_level == 0) {
                    $candidate[] = json_decode(json_encode([
                        'user_id' => $user->id,
                        'full_name' => $user->full_name,
                        'gender' => $user->gender,
                        'date_birth' => $user->date_birth,
                        'phone_number' => $user->phone_number,
                        'email' => $user->email,
                        'created_at' => $user->created_at->toDateTimeString(),
                        'updated_at' => $user->updated_at->toDateTimeString(),
                    ]));
                } else {
                    $company = $user->company;
                    $recruiter[] = json_decode(json_encode([
                        'user_id' => $user->id,
                        'company_name' => $company->company_name,
                        'logo_url' => $company->logo_url,
                        'full_name' => $user->full_name,
                        'gender' => $user->gender,
                        'date_birth' => $user->date_birth,
                        'phone_number' => $user->phone_number,
                        'email' => $user->email,
                        'created_at' => $user->created_at->toDateTimeString(),
                        'updated_at' => $user->updated_at->toDateTimeString(),
                    ]));
                }
            }
            $count = $list_user->count();
            return response()->json([
                'message' => 'Success',
                'count' => $count,
                'candidate' => $candidate,
                'recruiter' => $recruiter,
            ], 200);
        }
    }

    /**
     * Single job by id
     * only Admin can access this function
     */
    public function getJob(Request $request, $id)
    {
        if ($request->user()->isAdmin()) {
            // get job detail and number of apply
            $job = JobDetail::where('id', $id)->first();
            $job->number_apply = JobApply::where('job_id', $id)->count();

            return response()->json([
                'message' => 'Success',
                'data' => $job
            ], 200);
        } else {
            return response()->json([
                'message' => 'You are not admin'
            ], 403);
        }
        return response()->json([
            'message' => 'You are not admin'
        ], 403);
    }

    /** 
     * Get list company 
     * 
     * @return \Illuminate\Http\Response
     */
    public function listCompany(Request $request)
    {
        // only Admin can access this function
        if (!$request->user()->isAdmin()) {
            return response()->json([
                'message' => 'You are not admin'
            ], 403);
        } else {
            $data = [];
            $list_company = UserCompany::all();
            foreach ($list_company as $company) {
                $data[] = json_decode(json_encode([
                    'company_id' => $company->id,
                    'company_name' => $company->company_name,
                    'logo_url' => $company->logo_url,
                    'job_count' => $company->job->count(),
                    'created_at' => $company->created_at->toDateTimeString(),
                    'updated_at' => $company->updated_at->toDateTimeString(),
                ]));
            }
            $count = $list_company->count();
            return response()->json([
                'message' => 'Success',
                'count' => $count,
                'data' => $data,
            ], 200);
        }
    }
    /** 
     * Get list question
     * 
     * @return \Illuminate\Http\Response
     */
    public function listQuestion(Request $request)
    {
        // only Admin can access this function
        if (!$request->user()->isAdmin()) {
            return response()->json([
                'message' => 'You are not admin'
            ], 403);
        } else {
            $list_ques = QuestionDetail::all();
            $apptitude = [];
            $personality = [];
            foreach ($list_ques as $ques) {
                $type = $ques->type;
                if (in_array($ques->type_id, [1, 2, 3])) {
                    $option = $ques->option;
                    $apptitude[] = json_decode(json_encode([
                        'ques_id' => $ques->id,
                        'type_name' => $type->type_name,
                        'ques_content' => $ques->ques_content,
                        'ques_option' => $option,
                        'created_at' => $ques->created_at->toDateTimeString(),
                        'updated_at' => $ques->updated_at->toDateTimeString(),
                    ]));
                } else {
                    $personality[] = json_decode(json_encode([
                        'ques_id' => $ques->id,
                        'type_name' => $type->type_name,
                        'ques_content' => $ques->ques_content,
                        'created_at' => $ques->created_at->toDateTimeString(),
                        'updated_at' => $ques->updated_at->toDateTimeString(),
                    ]));
                }
            }
            $count = $list_ques->count();
            return response()->json([
                'message' => 'Success',
                'count' => $count,
                'apptitude' => $apptitude,
                'personality' => $personality,
            ], 200);
        }
    }
}