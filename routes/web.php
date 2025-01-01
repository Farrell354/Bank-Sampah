<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WasteTransactionController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/dashboard', function () {
    return view('pages.dashboard');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
Route::get('/maps', function () {
    return view('maps');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/waste-transactions', [WasteTransactionController::class, 'store'])->name('waste-transactions.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/waste-transactions', [WasteTransactionController::class, 'index'])->name('waste-transactions.index');
    Route::post('/waste-transactions', [WasteTransactionController::class, 'store'])->name('waste-transactions.store');
    Route::delete('/waste-transactions/{id}', [WasteTransactionController::class, 'destroy'])->name('waste-transactions.destroy');
});

Route::post('/waste-transactions/store', [WasteTransactionController::class, 'store'])->name('waste-transactions.store');

Route::get('/dashboard', [WasteTransactionController::class, 'index'])->name('dashboard');

Route::get('/dashboard', [WasteTransactionController::class, 'index'])->name('dashboard')->middleware('auth');
Route::post('/waste-transactions/store', [WasteTransactionController::class, 'store'])->name('waste-transactions.store')->middleware('auth');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
