<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MypageController;

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

Route::get('/mypage', function () {
    return view('mypage');
})->name('mypage');

Route::get('/lastboard', function () {
    return view('lastboard');
})->name('lastboard');

Route::get('/insert', function () {
    return view('insert');
})->name('insert');

Route::get('/detail/{board}', [BoardController::class, 'show'])->name('detail');
Route::post('/comments', [CommentController::class, 'store'])->name('comments');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::resource('/board', BoardController::class);
// GET|HEAD        board ..................................... board.index › BoardController@index  
// POST            board ..................................... board.store › BoardController@store  
// GET|HEAD        board/create .............................. board.create › BoardController@create  
// GET|HEAD        board/{board} ............................. board.show › BoardController@show  
// PUT|PATCH       board/{board} ............................. board.update › BoardController@update  
// DELETE          board/{board} ............................. board.destroy › BoardController@destroy  
// GET|HEAD        board/{board}/edit ........................ board.edit › BoardController@edit  
Route::get('/categoryboard',[BoardController::class,'categoryboard'])->name('categoryboard');

Route::get('/', [MainController::class, 'mainget'])->name('main.get');
Route::post('/partselect', [MainController::class, 'partselectpost']);
Route::post('/symptomselect', [MainController::class, 'symptomselectpost']);
Route::post('/useraddress', [MainController::class, 'useraddresspost']);

Route::get('/login', [UserController::class, 'loginget'])->name('login.get');
Route::post('/login', [UserController::class, 'loginpost'])->name('login.post');
Route::get('/regist', [UserController::class, 'registget'])->name('regist.get');
Route::post('/regist', [UserController::class, 'registpost'])->name('regist.post');
Route::get('/logout', [UserController::class, 'logoutget'])->name('logout.get');

// mypage
Route::get('/mypage', [MypageController::class, 'mypageget'])->name('mypage.get');
Route::post('/myhashdelete', [MypageController::class, 'myhashdeletepost'])->name('myhash.post');
Route::get('/allhashtag', [MypageController::class, 'allhashget'])->name('allhash.post');
Route::post('/addfavoritehashtag', [MypageController::class, 'addfavoritehashtagpost'])->name('allhash.post');

Route::get('/timeline', [MypageController::class, 'todaytimelineget'])->name('todaytimeline.get');
Route::post('/daytimeline', [MypageController::class, 'daytimelinepost'])->name('daytimeline.post');

Route::post('/namechk', [UserController::class, 'namechkpost']);
Route::post('/idchk', [UserController::class, 'idchkpost']);