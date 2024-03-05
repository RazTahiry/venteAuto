<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AchatController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\Admin\VoitureController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/admin/view-pdf', [AchatController::class, 'viewPDF'])->name('view-pdf');

Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'dologin']);
Route::delete('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('admin/achat/create/{client_id}', [AchatController::class, 'create'])->name('admin.achat.create');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function() {
    Route::resource('client', ClientController::class);
    Route::resource('voiture', VoitureController::class);
    Route::resource('achat', AchatController::class);
    Route::resource('dashboard', dashboardController::class);
});
