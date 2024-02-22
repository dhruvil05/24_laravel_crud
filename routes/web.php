<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
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
    
    Route::get('timer', function(){return view('timer');})->name('timer');
    
    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::get('users/view/{id?}', [UserController::class, 'show'])->name('user.view');
    
    Route::group(['middleware'=>['roles:SuperAdmin,Admin,Tester']], function(){
        Route::group(['middleware'=>['roles:SuperAdmin,Admin']], function(){

            Route::get('create', [StudentController::class, 'index'])->name('create');
            Route::post('create', [StudentController::class, 'store'])->name('store');
            Route::get('update/{id}', [StudentController::class, 'getStudentData'])->name('getStudent');
            Route::post('update/{id?}', [StudentController::class, 'update'])->name('update');

            Route::get('users/create', [UserController::class, 'create'])->name('user.create');
            Route::post('users/create', [UserController::class, 'store'])->name('user.store');
            Route::get('users/edit/{id?}', [UserController::class, 'edit'])->name('user.edit');
            Route::put('users/edit/{id?}', [UserController::class, 'update'])->name('user.update');

            Route::group(['middleware'=>['roles:SuperAdmin']], function(){
                Route::post('delete/{id}', [StudentController::class, 'delete'])->name('delete');

                Route::get('users/delete/{id?}', [UserController::class, 'destroy'])->name('user.delete');

                Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

            });
        });
    });
});
// 
require __DIR__.'/auth.php';
