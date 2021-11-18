<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ResetPasswordController;
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

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'getPassword'])->name('reset-password');
Route::post('reset-password', [ResetPasswordController::class, 'updatePassword'])->name('reset-password');