<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExpenseController;
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

Route::middleware('auth')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('events', EventController::class)->except('index');
    Route::get('/events/{event}/result', [EventController::class, 'result'])->name('events.show.result');
    Route::post('/events/{event}/invite', [EventController::class, 'invite'])->name('events.invite');
    Route::get('/events/{event}/expenses/create', [ExpenseController::class, 'create'])->name('events.expenses.create');
    Route::post('/events/{event}/expenses', [ExpenseController::class, 'store'])->name('events.expenses.store');
});

require __DIR__ . '/auth.php';
