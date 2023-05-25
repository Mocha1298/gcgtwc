<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Master;

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


    // ROUTE ASPEK start
        Route::get('/aspek','App\Http\Controllers\AspectController@home');
        Route::post('/aspek','App\Http\Controllers\AspectController@add');
        Route::get('/edit/aspek/{id}','App\Http\Controllers\AspectController@edit');
        Route::post('/edit/aspek/{id}','App\Http\Controllers\AspectController@update');
        Route::get('/delete/aspek/{id}','App\Http\Controllers\AspectController@delete');
    // ROUTE ASPEK end
    // ROUTE INDIKATOR start
        Route::get('/indikator','App\Http\Controllers\IndicatorController@home');
        Route::post('/indikator','App\Http\Controllers\IndicatorController@add');
        Route::get('/edit/indikator/{id}','App\Http\Controllers\IndicatorController@edit');
        Route::post('/edit/indikator/{id}','App\Http\Controllers\IndicatorController@update');
        Route::get('/delete/indikator/{id}','App\Http\Controllers\IndicatorController@delete');
    // ROUTE INDIKATOR end
    // ROUTE PARAMETER start
        Route::get('/parameter','App\Http\Controllers\ParameterController@home');
        Route::post('/parameter','App\Http\Controllers\ParameterController@add');
        Route::get('/edit/parameter/{id}','App\Http\Controllers\ParameterController@edit');
        Route::post('/edit/parameter/{id}','App\Http\Controllers\ParameterController@update');
        Route::get('/delete/parameter/{id}','App\Http\Controllers\ParameterController@delete');
    // ROUTE PARAMETER end
    // ROUTE FAKTOR start
        Route::get('/faktor','App\Http\Controllers\FactorController@home');
        Route::post('/faktor','App\Http\Controllers\FactorController@add');
        Route::get('/edit/faktor/{id}','App\Http\Controllers\FactorController@edit');
        Route::post('/edit/faktor/{id}','App\Http\Controllers\FactorController@update');
        Route::get('/delete/faktor/{id}','App\Http\Controllers\FactorController@delete');
    // ROUTE FAKTOR end
    // ROUTE SUB start
        Route::get('/subfaktor','App\Http\Controllers\SubFactorController@home');
        Route::post('/subfaktor','App\Http\Controllers\SubFactorController@add');
        Route::get('/edit/subfaktor/{id}','App\Http\Controllers\SubFactorController@edit');
        Route::post('/edit/subfaktor/{id}','App\Http\Controllers\SubFactorController@update');
        Route::get('/delete/subfaktor/{id}','App\Http\Controllers\SubFactorController@delete');
    // ROUTE SUB end

    // ROUTE REPORT 
        // Route::get('report','')
    // ROUTE REPORT


    Route::get('/report', function () {
        $aspek = Master::where('jenis','Aspek')->get();
        $indikator = Master::where('jenis','Indikator')->get();
        $parameter = Master::where('jenis','Parameter')->get();
        $faktor = Master::where('jenis','faktor')->get();
        $sub = Master::where('jenis','Sub')->get();
        // return $sub;
        $data = [
            'aspek'=>$aspek,
            'indikator'=>$indikator,
            'parameter'=>$parameter,
            'faktor'=>$faktor,
            'sub'=>$sub
        ];
        return view('table',$data);
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