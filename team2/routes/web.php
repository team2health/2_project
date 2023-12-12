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

Route::get('/', function () {
    return view('main');
});

Route::get('/mypage', function () {
    return view('mypage');
});

Route::get('/timeline', function () {
    return view('timeline');
});


Route::get('/lastboard', function () {
    return view('lastboard');
});

Route::get('/insert', function () {
    return view('insert');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/regist', function () {
    return view('regist');
});