<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\JobApplyController;
use App\Http\Controllers\API\JobDetailController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\QuestionDetailController;
use App\Http\Controllers\API\ScanCV;
use App\Http\Controllers\API\QuestionResultController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\API\ManagePageController;
// use App\Http\Controllers\API\VerifyEmailController;

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


// Route::group(['middleware' => 'verified'], function () {
/**
 * Login API
 * @queryParam required: email, password
 * Password default: password
 */
Route::post('login', [UserController::class, 'login']);
// });


/**
 * Register API
 * @queryParam required: full_name, gender, date_birth, phone_number, email, password
 */
Route::post('register', [UserController::class, 'register']);

/**
 * Forget password View
 * Note: API is used only for forget password template, not need to call
 * Không cn gọi cái này nha Đô
 */
Route::get('forget-password', [ForgotPasswordController::class, 'getEmail'])
    ->name('forget-password');

/** 
 * Forgot password API
 * @queryParam required: email
 */
Route::post('password/forgot', [ForgotPasswordController::class, 'postEmail']);

/** 
 * Reset password API
 * @queryParam required: token, email, password
 */
Route::post('password/reset', [ResetPasswordController::class, 'updatePassword']);

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

/**
 * Show statistic about total of companies, applies, jobs, users API 
 * For page 'Home page' website
 */
Route::get('statistic', [ManagePageController::class, 'statistic']);

// // Verify email
// Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
//     // ->middleware(['signed', 'throttle:6,1'])
//     ->name('verification.verify');

// // Resend link to verify email
// Route::post('/email/verify/resend', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();
//     return response()->json(["success" => true, "message" => "Email verification link has been sent to your email."]);
// })->middleware(['auth:api', 'throttle:6,1'])->name('verification.send');

/**
 * Download CV file API 
 * @queryParam required: cv_path
 */
Route::get('downcv', [JobApplyController::class, 'downCV']);


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
    Route::get('logout', [UserController::class, 'logout']);

    /**
     * User's information API
     * @queryParam required: api_token
     */
    Route::get('login', [UserController::class, 'check']);

    /** 
     * Change password API
     * @queryParam required: api_token, current_password, new_password
     */
    Route::post('password/change', [HomeController::class, 'changePassword']);

    /** 
     * Update profile API
     * @queryParam required: api_token, full_name, gender, date_birth, phone_number, company_name, logo_url
     * Note: if user is candidate then 'company_name', 'logo_url' params is not need define
     */
    Route::post('user/profile', [UserController::class, 'profile']);


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
     * @queryParam required: api_token, job_title, job_descrip, job_require, job_benefit, work_time, job_place, salary, date_expire, job_keyword[keyword, weight]
     * Note: if job's work time is fulltime (value: 'f') else is parttime (value: 'p')
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
     * @queryParam required: api_token, job_title, job_descrip, job_require, job_benefit, work_time, job_place, salary, date_expire, job_keyword[keyword, weight]
     */
    Route::post('recruiter/job/update/{job_id}', [JobDetailController::class, 'update']);

    /**
     * Close a job  API 
     * For page 'View job' of recruiter
     * @queryParam required: api_token
     */
    Route::get('recruiter/job/close/{job_id}', [JobDetailController::class, 'destroy']);

    /**
     * Add a specific question API 
     * For page 'Add question' of recruiter
     * @queryParam required: api_token, type_id, ques_content, ques_option[opt_content, correct]
     * Notes: 'type_id' in table 'question_types', if aptitude question (type_id is 1,2,3) then param 'ques_option' must have, if option correct is 1 else 0
     */
    Route::post('recruiter/ques/add', [QuestionDetailController::class, 'store']);

    /**
     * View all questions which recruiter of a company had added API 
     * For page 'View question' of recruiter
     * @queryParam required: api_token
     */
    Route::get('recruiter/ques/view', [QuestionDetailController::class, 'index']);

    /**
     * View all details of a question which had added to edit API 
     * For page 'Add question' when edit but not submit yet of recruiter
     * @queryParam required: api_token
     */
    Route::get('recruiter/ques/edit/{question_id}', [QuestionDetailController::class, 'edit']);

    /**
     * Update a question which had added API 
     * For page 'Add question' when click submit edit of recruiter
     * @queryParam required: api_token, type_id, ques_content, ques_option[opt_content, correct]
     */
    Route::post('recruiter/ques/update/{question_id}', [QuestionDetailController::class, 'update']);

    /**
     * Delete a question  API 
     * For page 'View question' of recruiter
     * @queryParam required: api_token
     */
    Route::get('recruiter/ques/delete/{question_id}', [QuestionDetailController::class, 'destroy']);


    //---API OF CANDIDATE---
    /**
     * Upload a specific CV file (.pdf) and return result API 
     * For page 'Job details' of candidate
     * @queryParam required: api_token, job_id, cv_file, cv_new
     * Note: cv_new default is null, if use new cv file then cv_new is true, else cv_new is false
     */
    Route::post('candidate/job/upload', [JobApplyController::class, 'store']);

    /**
     * Check if the candidate has applied or not API 
     * For page 'Job details' of candidate
     * @queryParam required: api_token
     */
    Route::get('candidate/apply/check', [JobApplyController::class, 'check']);

    /**
     * Get quiz API for candidate 
     * For page 'Test quiz' of candidate
     * @queryParam required: api_token,
     */
    Route::get('candidate/quiz/test', [QuestionResultController::class, 'index']);

    /**
     * Save test quiz results API for candiate 
     * For page 'Test quiz' of candidate
     * @queryParam required: api_token, ques_result[type_id, score]
     * Note: 'score' is total score for a type of question
     */
    Route::post('candidate/quiz/result', [QuestionResultController::class, 'store']);


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

    /**
     * Total companies
     * only Admin
     * @queryParam required: api_token
     */
    Route::get('admin/listCompany', [AdminController::class, 'listCompany']);

    /**
     * Total questions
     * only Admin
     * @queryParam required: api_token
     */
    Route::get('admin/listQuestion', [AdminController::class, 'listQuestion']);

    /**
     * Test Scan CV file upload
     * only Admin
     * @queryParam required: api_token, file_cv, lang
     */
    Route::post('admin/scan', [ScanCV::class, 'index']);
});