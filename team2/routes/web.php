<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BoardController;


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

Route::get('/detail/{board}', [BoardController::class, 'show'])->name('detail');

Route::resource('/board', BoardController::class);
Route::get('/categoryboard',[BoardController::class,'categoryboard'])->name('categoryboard');


Route::get('/login', [UserController::class, 'loginget'])->name('login.get');
Route::post('/login', [UserController::class, 'loginpost'])->name('login.post');
Route::get('/regist', [UserController::class, 'registget'])->name('regist.get');
Route::post('/regist', [UserController::class, 'registpost'])->name('regist.post');
Route::get('/logout', [UserController::class, 'logoutget'])->name('logout.get');

// Route::post('/namechk', [UserController::class, 'namechkpost']);