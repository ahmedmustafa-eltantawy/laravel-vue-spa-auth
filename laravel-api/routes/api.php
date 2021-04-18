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

Route::post('login', [ \App\Http\Controllers\Api\LoginController::class, 'login' ])->name('login');

Route::post('register', [ \App\Http\Controllers\Api\RegisterController::class, 'register' ])->name('register');



Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/verify-email', [ \App\Http\Controllers\Api\VerificationController::class, 'store' ])
            ->name('verification.email');

    Route::post('/verify-email/{id}/{hash}', [\App\Http\Controllers\Api\VerificationController::class, 'markEmailAsVerified'])
            ->name('email.verify');

    Route::post('/has-verify-email', [\App\Http\Controllers\Api\VerificationController::class, 'hasVerifiedEmail'])
            ->name('email.has-verify');

    Route::group([ 'middleware' => ['admin.dashboard'] ], function() {
        Route::apiResource( 'statistics', \Dashboard\StatisticsController::class );
    });

});


