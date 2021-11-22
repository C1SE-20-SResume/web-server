<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\JobApplyController;
use App\Http\Controllers\API\JobDetailController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\QuestionDetailController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

/**
 * User's information API
 * @queryParam required: api_token
 */
Route::get('login', [UserController::class, 'check']);

/**
 * Login API
 * @queryParam required: email, password
 * Password default: password
 */
Route::post('login', [UserController::class, 'login']);

/**
 * Register API
 * @queryParam required: full_name, gender, date_birth, phone_number, email, password
 */
Route::post('register', [UserController::class, 'register']);

/**
 * Forget password
 */

Route::get('forget-password', [ForgotPasswordController::class, 'getEmail'])
    ->name('forget-password');

/** 
 * @queryParam required: email
 */
Route::post('forget-password', [ForgotPasswordController::class, 'postEmail'])
    ->name('forget-password');

/**
 * Show all jobs API 
 * For page 'View job'
 */
Route::get('job', [JobDetailController::class, 'index']);

/**
 * Show all details of a specific job API 
 * for 'Job Details' when click a specific job in page 'View job'
 */
Route::get('job/{job_id}', [JobDetailController::class, 'show']);

/**
 * Show 5 jobs which had highest number of applies API 
 * For page 'Home page' website
 */
Route::get('popularjob', [JobDetailController::class, 'homepage']);


Route::group(['middleware' => 'auth:api'], function () {

    /**
     * Get auth user current 
     * @queryParam required: api_token
     */
    Route::get('user', [UserController::class, 'getUser']);
    /**
     * Logout API
     * @queryParam required: api_token
     */
    Route::post('logout', [UserController::class, 'logout']);

    //---API OF RECRUITER---

    /**
     * Show summarizes the number of applies for each job API
     * for page 'Home' of recruiter
     * @queryParam required: api_token
     */
    Route::get('recruiter/apply', [JobApplyController::class, 'index']);

    /**
     * Show all apply details of a specific job API 
     * for 'Apply Details' when click a specific apply in page 'Home' of recruiter
     * @queryParam required: api_token
     */
    Route::get('recruiter/apply/{job_id}', [JobApplyController::class, 'show']);

    /**
     * Add a specific job API 
     * For page 'Add job' of recruiter
     * @queryParam required: api_token, job_title, job_descrip, job_require, job_benefit, job_place, salary, date_expire, job_keyword[keyword, weight]
     */
    Route::post('recruiter/job/add', [JobDetailController::class, 'store']);

    /**
     * View all jobs which recruiter of a company had added API 
     * For page 'View job' of recruiter
     * @queryParam required: api_token
     */
    Route::get('recruiter/job/view', [JobDetailController::class, 'view']);

    /**
     * View all details of a job which had added to edit API 
     * For page 'Add job' when edit but not submit yet of recruiter
     * @queryParam required: api_token
     */
    Route::get('recruiter/job/edit/{job_id}', [JobDetailController::class, 'edit']);

    /**
     * Update a job which had added API 
     * For page 'Add job' when click submit edit of recruiter
     * @queryParam required: api_token, job_id, job_title, job_descrip, job_require, job_benefit, job_place, salary, date_expire, job_keyword[keyword, weight]
     */
    Route::post('recruiter/job/update', [JobDetailController::class, 'update']);

    /**
     * Delete a job  API 
     * For page 'View job' of recruiter
     * @queryParam required: api_token
     */
    // Route::get('recruiter/job/delete/{job_id}', [JobDetailController::class, 'destroy']);

    /**
     * Add a specific question API 
     * For page 'Add question' of recruiter
     * @queryParam required: api_token, type_id, ques_content, ques_option[opt_content, correct]
     * Notes: 'type_id' in table 'question_types', if apptitude question (type_id is 1,2,3) then param 'ques_option' must have, if option correct is 1 else 0
     */
    Route::post('recruiter/ques/add', [QuestionDetailController::class, 'store']);

    //---API OF CANDIDATE---

    /**
     * Upload a specific CV file (.pdf) and return result API 
     * For page 'Job details' of candidate
     * @queryParam required: api_token, job_id, cv_file
     */
    Route::post('candidate/job/upload', [JobApplyController::class, 'store']);


    //---API OF ADMIN---
    /** 
     * Total apply of all jobs API
     * only Admin
     * @queryParam required: api_token
     */
    Route::get('admin/job_applies', [JobApplyController::class, 'getAppliedJobs']);

    /**
     * Total job of all companies API
     * only Admin
     * @queryParam required: api_token
     */
    Route::get('admin/listJob', [AdminController::class, 'listJob']);

    /**
     * Total users 
     * only Admin
     * @queryParam required: api_token
     */
    Route::get('admin/listUser', [AdminController::class, 'listUser']);

    /**
     * Single job by id
     * only Admin
     * @queryParam required: api_token, job_id
     */
    Route::get('admin/job/{job_id}', [AdminController::class, 'getJob']);
});