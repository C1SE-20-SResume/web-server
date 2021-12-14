<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Http\Request;
use App\Http\Controllers\API\VerifyEmailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('reset-password/{token}', [ResetPasswordController::class, 'getPassword'])->name('reset-password');
Route::post('reset-password', [ResetPasswordController::class, 'updatePassword'])->name('reset-password');

// Verify email
Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    // ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

// Resend link to verify email
Route::post('/email/verify/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return response()->json(["success" => true, "message" => "Email verification link has been sent to your email."]);
})->middleware(['auth:api', 'throttle:6,1'])->name('verification.send');

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');

// Auth::routes(['verify' => true]);