<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\API\JobApplyController;
use App\Http\Controllers\API\JobDetailController;
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

Route::get('login', [UserController::class, 'check']);
/**
* Login API
* @queryParam required: email, password
* Password default: password
*/
Route::post('login', [UserController::class, 'login']);
/**
* Register API
* @queryParam required: full_name, gender, phone_number, email, password
*/
Route::post('register', [UserController::class, 'register']);

Route::group(['middleware' => 'auth:api'], function () {
    /**
    * Logout API
    * @queryParam required: api_token
    */
    Route::get('logout', [UserController::class, 'logout']);
    
    /**
    * Show all jobs API 
    * For page 'View job' of candidate
    * @queryParam required: api_token
    */
    Route::get('candidate/job', [JobDetailController::class, 'index']);
    
    /**
    * Show all details of a specific job API 
    * for 'Job Details' when click a specific job in page 'View job' of candidate
    * @queryParam required: api_token
    */
    Route::get('candidate/job/{id}', [JobDetailController::class, 'show']);
    
    /**
    * Show summarizes the number of applies for each job API
    * for page 'Home' of recruiter
    * @queryParam required: api_token
    */
    Route::get('recruiter/apply', [JobApplyController::class, 'index']);
    
    /**
    * Show all details of a specific apply API 
    * for 'Apply Details' when click a specific apply in page 'Home' of recruiter
    * @queryParam required: api_token
    */
    Route::get('recruiter/apply/{id}', [JobApplyController::class, 'show']);

    /**
    * Add a specific job API 
    * For page 'Add job' of recruiter
    * @queryParam required: api_token, company_id, job_title, job_descrip, job_benefit, job_place, salary, job_keyword[keyword, weight]
    */
    Route::post('recruiter/job/add', [JobDetailController::class, 'store']);
});
