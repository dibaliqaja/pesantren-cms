<?php

use App\Http\Controllers\CashBookController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\InMailController;
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
    return view('welcome');
});

Route::resource('santri', SantriController::class);
Route::resource('buku-kas', CashBookController::class);
Route::resource('surat-masuk', InMailController::class);
