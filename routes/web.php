<?php

use App\Http\Controllers\ProfileController;
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



Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/profile/{id}', [ProfileController::class, 'edit']);
    Route::post('/profile/{id}', [ProfileController::class, 'update']);
    Route::get('/profiled/{id}', [ProfileController::class, 'destroy']);

    Route::get('/aspek', function () {
        return view('master/aspek');
    });
    Route::get('/indikator', function () {
        return view('master/indikator');
    });
    Route::get('/parameter', function () {
        return view('master/parameter');
    });
    Route::get('/faktor', function () {
        return view('master/faktor');
    });
    Route::get('/sub', function () {
        return view('master/sub');
    });
    Route::get('/report', function () {
        return view('report');
    });
    Route::get('/index', function () {
        return view('layout');
    });

    // User
    Route::get('/user',[ProfileController::class, 'show'])->name('user');
    Route::get('/newuser',[ProfileController::class, 'create'])->name('create');
    Route::post('/newuser',[ProfileController::class, 'store'])->name('store');
});

require __DIR__.'/auth.php';