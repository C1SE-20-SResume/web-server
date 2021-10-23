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
        'code' => 0,
        'message' => 'Chưa đăng nhập',
    ]);
})->name('login');
Route::post('login', [App\Http\Controllers\API\UserController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [App\Http\Controllers\API\UserController::class, 'logout']);
    Route::get('candidate/jobs', [App\Http\Controllers\API\JobDetailController::class, 'index']);
    Route::get('candidate/jobs/{id}', [App\Http\Controllers\API\JobDetailController::class, 'show']);
    Route::get('recruiter/applies', [App\Http\Controllers\API\JobApplyController::class, 'index']);
    Route::get('recruiter/applies/{job_id}', [App\Http\Controllers\API\JobApplyController::class, 'show']);
});
