<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('login', function () {
    return response()->json([
        'status' => 0,
        'message' => 'Chưa đăng nhập',
    ]);
})->name('login');
/**
* Login API
* @queryParam required: email, password
* Password default: password
*/
Route::post('login', [App\Http\Controllers\API\UserController::class, 'login']);
/**
* Register API
* @queryParam required: full_name, gender, phone_number, email, password
*/
Route::post('register', [App\Http\Controllers\API\UserController::class, 'register']);

Route::group(['middleware' => 'auth:api'], function () {
    /**
    * Logout API
    * @queryParam required: api_token
    */
    Route::get('logout', [App\Http\Controllers\API\UserController::class, 'logout']);
    /**
    * Show all jobs API 
    * For page 'View job' of candidate
    * @queryParam required: api_token
    */
    Route::get('candidate/job', [App\Http\Controllers\API\JobDetailController::class, 'index']);
    /**
    * Show all details of a specific job API 
    * for 'Job Details' when click a specific job in page 'View job' of candidate
    * @queryParam required: api_token
    */
    Route::get('candidate/job/{id}', [App\Http\Controllers\API\JobDetailController::class, 'show']);
    /**
    * Show summarizes the number of applies for all jobs API
    * for page 'Home' of recruiter
    * @queryParam required: api_token
    */
    Route::get('recruiter/apply', [App\Http\Controllers\API\JobApplyController::class, 'index']);
    /**
    * Show all details of a specific apply API 
    * for 'Apply Details' when click a specific apply in page 'Home' of recruiter
    * @queryParam required: api_token
    */
    Route::get('recruiter/apply/{id}', [App\Http\Controllers\API\JobApplyController::class, 'show']);
    /**
    * Add a specific job API 
    * For page 'Add job' of recruiter
    * @queryParam required: api_token, company_id, job_title, job_descrip, job_benefit, job_place, salary, job_keyword[keyword, weight]
    */
    Route::post('recruiter/job/add', [App\Http\Controllers\API\JobDetailController::class, 'store']);
});
