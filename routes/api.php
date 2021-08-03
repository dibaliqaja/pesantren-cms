<?php

use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CashBookController;
use App\Http\Controllers\API\SantriController;
use App\Http\Controllers\API\PasswordController;
use App\Http\Controllers\API\SyahriahController;
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

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function ($router) {
    // Auth
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);

    // Cashbook
    Route::get('buku-kas', [CashBookController::class, 'index']);

    // Change Password
    Route::post('password', [PasswordController::class, 'update']);
    
    // Profile
    Route::get('profile', [ProfileController::class, 'show']);
    Route::post('profile', [ProfileController::class, 'update']);

    // Syahriah
    Route::get('syahriah-history', [SyahriahController::class, 'index_history']);
    Route::get('syahriah-spp', [SyahriahController::class, 'index_spp']);
});
