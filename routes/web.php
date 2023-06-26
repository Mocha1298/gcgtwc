<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Master;
use Illuminate\Http\Request;
// use File;

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
    Route::get('/', 'App\Http\Controllers\ReportController@dashboard');

    // Route::get('/dashboard', function () {
    //     $sub = Master::where('jenis','Sub')->get();
    //     $faktor = Master::where('jenis','Faktor')->get();
    //     $parameter = Master::where('jenis','Parameter')->get();
    //     $indikator = Master::where('jenis','Indikator')->get();
    //     $aspek = Master::where('jenis','Aspek')->get();

    //     $data = [
    //         'aspek'=>$aspek,
    //         'indikator'=>$indikator,
    //         'parameter'=>$parameter,
    //         'faktor'=>$faktor,
    //         'sub'=>$sub,
    //         'total'=>$total
    //     ];
    //     return view('dashboard',$data);
    // })->middleware(['auth', 'verified'])->name('dashboard');
});
Route::get('/report/{tahun}','App\Http\Controllers\ReportController@index');
Route::post('/summary/{id}', 'App\Http\Controllers\ReportController@each_value');

Route::get('getdet/{id}/{type}','App\Http\Controllers\ReportController@getdet');
Route::post('/summary/{type}/{id}', 'App\Http\Controllers\ReportController@note');
Route::middleware('admin')->group(function (){
    // User
    Route::get('/user',[ProfileController::class, 'show'])->name('user');
    Route::get('/newuser',[ProfileController::class, 'create'])->name('create');
    Route::post('/newuser',[ProfileController::class, 'store'])->name('store');
    Route::get('/profile/{id}', [ProfileController::class, 'edit']);
    Route::post('/profile/{id}', [ProfileController::class, 'update']);
    Route::get('/delete/profile/{id}', [ProfileController::class, 'destroy']);


    // ROUTE ASPEK start
        Route::get('/aspek/{tahun}','App\Http\Controllers\AspectController@home');
        Route::post('/aspek/{tahun}','App\Http\Controllers\AspectController@add');
        Route::get('/edit/aspek/{id}','App\Http\Controllers\AspectController@edit');
        Route::post('/edit/aspek/{id}','App\Http\Controllers\AspectController@update');
        Route::get('/delete/aspek/{id}','App\Http\Controllers\AspectController@delete');
    // ROUTE ASPEK end
    // ROUTE INDIKATOR start
        Route::get('/indikator/{tahun}','App\Http\Controllers\IndicatorController@home');
        Route::post('/indikator/{tahun}','App\Http\Controllers\IndicatorController@add');
        Route::get('/edit/indikator/{id}','App\Http\Controllers\IndicatorController@edit');
        Route::post('/edit/indikator/{id}','App\Http\Controllers\IndicatorController@update');
        Route::get('/delete/indikator/{id}','App\Http\Controllers\IndicatorController@delete');
    // ROUTE INDIKATOR end
    // ROUTE PARAMETER start
        Route::get('/parameter/{tahun}','App\Http\Controllers\ParameterController@home');
        Route::post('/parameter/{tahun}','App\Http\Controllers\ParameterController@add');
        Route::get('/edit/parameter/{id}','App\Http\Controllers\ParameterController@edit');
        Route::post('/edit/parameter/{id}','App\Http\Controllers\ParameterController@update');
        Route::get('/delete/parameter/{id}','App\Http\Controllers\ParameterController@delete');
    // ROUTE PARAMETER end
    // ROUTE FAKTOR start
        Route::get('/faktor/{tahun}','App\Http\Controllers\FactorController@home');
        Route::post('/faktor/{tahun}','App\Http\Controllers\FactorController@add');
        Route::get('/edit/faktor/{id}','App\Http\Controllers\FactorController@edit');
        Route::post('/edit/faktor/{id}','App\Http\Controllers\FactorController@update');
        Route::get('/delete/faktor/{id}','App\Http\Controllers\FactorController@delete');
    // ROUTE FAKTOR end
    // ROUTE SUB start
        Route::get('/subfaktor/{tahun}','App\Http\Controllers\SubFactorController@home');
        Route::post('/subfaktor/{tahun}','App\Http\Controllers\SubFactorController@add');
        Route::get('/edit/subfaktor/{id}','App\Http\Controllers\SubFactorController@edit');
        Route::post('/edit/subfaktor/{id}','App\Http\Controllers\SubFactorController@update');
        Route::get('/delete/subfaktor/{id}','App\Http\Controllers\SubFactorController@delete');
    // ROUTE SUB end
});

require __DIR__.'/auth.php';


// Route::get('/coba',function () {
//     return view('coba');
// });
// Route::post('/coba', function (Request $req) {
//     // return $req->input('kontol');
//     $i = 1;
//     // dd($req->all('index1'));
//     if($req->all('index1')){
//         return "TERISI";
//     }else{
//         return "KOSONG";
//     }
// });


Route::get('/clear-cache', function(){
    // Artisan::call('clear:cache');
    Artisan::call('clear:view');
    Artisan::call('clear:config');
});