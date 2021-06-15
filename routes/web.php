<?php

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
    // Dashboard
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Change Password
    Route::get('password', [App\Http\Controllers\PasswordController::class, 'change'])->name('change.password');
    Route::patch('password', [App\Http\Controllers\PasswordController::class, 'update'])->name('update.password');

    // Santri
    Route::resource('santri', SantriController::class);

    // Cost
    Route::get('biaya', [\App\Http\Controllers\CostController::class, 'index'])->name('biaya.index');
    Route::get('biaya/edit', [\App\Http\Controllers\CostController::class, 'edit'])->name('biaya.edit');
    Route::patch('biaya/edit', [\App\Http\Controllers\CostController::class, 'update'])->name('biaya.update');

    // Cash Book
    Route::get('buku-kas', [\App\Http\Controllers\CashBookController::class, 'index'])->name('buku-kas.index');
    Route::get('buku-kas/debit/create', [\App\Http\Controllers\CashBookController::class, 'createDebit'])->name('buku-kas.debit.create');
    Route::post('buku-kas/debit', [\App\Http\Controllers\CashBookController::class, 'storeDebit'])->name('buku-kas.debit.store');
    Route::get('buku-kas/credit/create', [\App\Http\Controllers\CashBookController::class, 'createCredit'])->name('buku-kas.credit.create');
    Route::post('buku-kas/credit', [\App\Http\Controllers\CashBookController::class, 'storeCredit'])->name('buku-kas.credit.store');
    Route::delete('buku-kas/{id}', [\App\Http\Controllers\CashBookController::class, 'destroy'])->name('buku-kas.destroy');

    // Syahriah
    Route::get('syahriah', [\App\Http\Controllers\SyahriahController::class, 'index'])->name('syahriah.index');

    // In Mail
    Route::resource('surat-masuk', InMailController::class);

    // Out Mail
    Route::resource('surat-keluar', OutMailController::class);

    // User
    Route::resource('pengguna', UserController::class);

    // Activity Log
    Route::get('activity-log', [App\Http\Controllers\ActivityLogController::class, 'index'])->name('activity.index');
});
