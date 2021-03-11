<?php

use App\Http\Controllers\CashBookController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\InMailController;
use App\Http\Controllers\OutMailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('password', [App\Http\Controllers\PasswordController::class, 'change'])->name('change.password');
    Route::patch('password', [App\Http\Controllers\PasswordController::class, 'update'])->name('update.password');
    Route::get('activity-log', [App\Http\Controllers\ActivityLogController::class, 'index'])->name('activity.index');

    Route::resource('santri', SantriController::class);
    Route::resource('buku-kas', CashBookController::class);
    Route::resource('surat-masuk', InMailController::class);
    Route::resource('surat-keluar', OutMailController::class);
    Route::resource('pengguna', UserController::class);
});
