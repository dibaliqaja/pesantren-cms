<?php

use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\AuthController;
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

Route::group(['middleware' => 'api', 'prefix' => 'v1.0'], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);

    Route::get('/profile', [ProfileController::class, 'userProfile']);
    Route::post('/update-profile', [ProfileController::class, 'updateProfile']);
});

// Route::group(['prefix' => 'v1.0'], function () {
//     Route::resource('santri', SantriController::class);
// });
