<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AchatController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\VoitureController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function() {
    Route::resource('client', ClientController::class);
    Route::resource('voiture', VoitureController::class);
    Route::resource('achat', AchatController::class);
    Route::resource('dashboard', dashboardController::class);
});
