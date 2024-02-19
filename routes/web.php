<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/test', function(){
    return view('test');
})->middleware(['auth'])->name('test');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('create', [StudentController::class, 'index'])->name('create');
    Route::post('create', [StudentController::class, 'store'])->name('store');
    Route::get('update/{id}', [StudentController::class, 'getStudentData'])->name('getStudent');
    Route::post('update/{id?}', [StudentController::class, 'update'])->name('update');
    Route::post('delete/{id}', [StudentController::class, 'delete'])->name('delete');

    Route::get('timer', function(){return view('timer');})->name('timer');
});

require __DIR__.'/auth.php';
