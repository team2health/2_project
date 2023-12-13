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
})->name('main');

Route::get('/mypage', function () {
    return view('mypage');
})->name('mypage');

Route::get('/timeline', function () {
    return view('timeline');
})->name('timeline');


Route::get('/lastboard', function () {
    return view('lastboard');
})->name('lastboard');

Route::get('/insert', function () {
    return view('insert');
})->name('insert');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/regist', function () {
    return view('regist');
})->name('regist');

Route::get('/detail', function () {
    return view('detail');
})->name('detail');

Route::get('/update', function () {
    return view('update');
})->name('update');

Route::get('/categoryboard', function () {
    return view('categoryboard');
})->name('categoryboard');

Route::get('/community', function () {
    return view('community');
})->name('community');

