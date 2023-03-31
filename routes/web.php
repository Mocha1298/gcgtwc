<?php

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

Route::get('/login', function () {
    return view('login');
});
Route::get('/', function () {
    return view('dashboard');
});
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
Route::get('/user', function () {
    return view('user');
});
Route::get('/report', function () {
    return view('report');
});
Route::get('/index', function () {
    return view('layout');
});

