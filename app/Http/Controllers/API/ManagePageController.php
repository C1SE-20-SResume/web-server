<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ManagePage;
use App\Models\UserCompany;
use App\Models\JobApply;
use App\Models\JobDetail;
use App\Models\User;

class ManagePageController extends Controller
{
    /**
     * Show statistic about total of companies, applies, jobs, users
     *
     * @return \Illuminate\Http\Response
     */
    public function statistic() {
        $company = UserCompany::all();
        $apply = JobApply::all();
        $job = JobDetail::all();
        $user = User::all();
        return response()->json([
            'success' => true,
            'company_count' => $company->count(),
            'apply_count' => $apply->count(),
            'job_count' => $job->count(),
            'user_count' => $user->count(),
        ]);
    }
}