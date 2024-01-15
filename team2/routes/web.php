<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\HashTagController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContentsadminController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Middleware\Adminauth;
use App\Http\Middleware\Adminblock;

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

Route::get('/detail/{board}', [BoardController::class, 'show'])->name('detail');
Route::post('/comments', [CommentController::class, 'store'])->name('comments');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::get('/boardcategory/{categoryId}', [BoardController::class, 'boardcategoryget']);
Route::post('/nextboard', [BoardController::class, 'nextboardpost']);
Route::post('/favoritenextboard', [BoardController::class, 'favoritenextboardpost']);
Route::post('/boardreport', [BoardController::class, 'boardreport'])->name('boardreport');
Route::post('/commentreport', [CommentController::class, 'commentreport'])->name('commentreport');
Route::get('/lastboard', [BoardController::class, 'lastboardget'])->name('lastboard.get');
Route::get('/hotboard', [BoardController::class, 'hotboardget'])->name('hotboard.get');
Route::get('/favoriteboard', [BoardController::class, 'favoriteboardget'])->name('favoriteboard.get');
Route::get('/categoryboard',[BoardController::class,'categoryboard'])->name('categoryboard');

Route::resource('/board', BoardController::class);
// GET|HEAD        board ..................................... board.index › BoardController@index  
// POST            board ..................................... board.store › BoardController@store  
// GET|HEAD        board/create .............................. board.create › BoardController@create  
// GET|HEAD        board/{board} ............................. board.show › BoardController@show  
// PUT|PATCH       board/{board} ............................. board.update › BoardController@update  
// DELETE          board/{board} ............................. board.destroy › BoardController@destroy  
// GET|HEAD        board/{board}/edit ........................ board.edit › BoardController@edit  

// main
Route::get('/', [MainController::class, 'mainget'])->name('main.get');
Route::post('/partselect', [MainController::class, 'partselectpost']);
Route::post('/symptomselect', [MainController::class, 'symptomselectpost']);
Route::get('/useraddress', [MainController::class, 'useraddressget']);

// user
Route::get('/login', [UserController::class, 'loginget'])->name('login.get');
Route::middleware('admin.block')->post('/login', [UserController::class, 'loginpost'])->name('login.post');
Route::get('/regist', [UserController::class, 'registget'])->name('regist.get');
Route::middleware('user.validation')->post('/regist', [UserController::class, 'registpost'])->name('regist.post');
Route::get('/logout', [UserController::class, 'logoutget'])->name('logout.get');
Route::post('/deleteacountchk', [UserController::class, 'deleteaccountchk']);
Route::get('/firstchkpassword', [UserController::class, 'firstchkpassword'])->middleware('auth')->name('firstchkpassword');
Route::post('/changpasswordchk', [UserController::class, 'changpasswordchk']);

Route::post('/namechk', [UserController::class, 'namechkpost']);
Route::post('/idchk', [UserController::class, 'idchkpost']);

// mypage
Route::get('/mypage', [MypageController::class, 'mypageget'])->middleware('auth')->name('mypage.get');
Route::post('/myhashdelete', [MypageController::class, 'myhashdeletepost'])->name('myhash.post');
Route::get('/allhashtag', [MypageController::class, 'allhashget'])->middleware('auth');
Route::post('/addfavoritehashtag', [MypageController::class, 'addfavoritehashtagpost']);
Route::post('/newcalendarblock', [MypageController::class, 'newcalendarblock']);
Route::post('/mypagecommentplus', [MypageController::class, 'mypagecommentplus']);
Route::post('/mypageboardplus', [MypageController::class, 'mypageboardplus']);
Route::post('/hashtagsearch', [MypageController::class, 'hashtagsearch']);

Route::post('/namechange', [MypageController::class, 'namechangepost']);
Route::post('/userinfoupdate', [MypageController::class, 'userinfoupdatepost']);
Route::post('/userimgremove', [MypageController::class, 'userimgremovepost']);

Route::get('/timeline', [MypageController::class, 'todaytimelineget'])->name('todaytimeline.get');
Route::post('/daytimeline', [MypageController::class, 'daytimelinepost'])->name('daytimeline.post');
Route::post('/recorddelete', [MypageController::class, 'recorddelete'])->name('recorddelete.post');

Route::get('/seeyouagain', [MypageController::class, 'seeyouagainget'])->name('seeyouagain');


// 이메일 확인 페이지 접속
Route::get('/emailchk', [UserController::class, 'emailchk'])->name('email.get');
Route::post('/emailchkgo', [UserController::class, 'emailchkpost'])->name('email.post');
// 이메일 확인하면 어디로 돌아가는지
// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');
// 이메일 확인 핸들러
// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
//     return redirect('/home');
// })->middleware(['auth', 'signed'])->name('verification.verify');
// 확인 이메일 재전송
// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();
//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// 경로 보호
Route::get('/profile', function () {
})->middleware(['auth', 'verified']);

// 관리자 페이지 라우트
Route::middleware('admin.block')->get('/admin', [AdminController::class, 'adminget'])->name('admin');
Route::post('/adminlogin', [AdminController::class, 'adminlogin'])->name('adminlogin.post');
Route::get('/adminlogout', [AdminController::class, 'adminlogout'])->name('admin.logout');

// 관리자 전용 라우트 등록하는 곳
Route::middleware(['admin.auth'])->group(function () {

Route::get('/admin/main', [AdminController::class, 'adminmain'])->name('admin.main');
Route::delete('/pandemicdelete', [AdminController::class, 'pandemicdelete']);
Route::post('/pandemicinsert', [AdminController::class, 'pandemicinsertpost']);
Route::get('/admin/hashtag', [AdminController::class, 'adminhashtagget'])->name('adminhashtag.get');
Route::delete('/hashtagdelete', [AdminController::class, 'hashtagdelete']);
Route::post('/hashtaginsert', [AdminController::class, 'hashtaginsertpost']);
Route::post('/adminregist', [AdminController::class, 'adminregistpost']);
    
Route::get('/admin/contents/{align_board?}', [ContentsadminController::class, 'admincontents'])->name('admin.contents');
Route::get('/admin/comments/{date?}', [ContentsadminController::class, 'admincomments'])->name('admin.comments');
Route::get('/admin/declaration', [ContentsadminController::class, 'contentsdeclaration'])->name('contents.declaration');
Route::post('/admin/deleteadminboard', [ContentsadminController::class, 'deleteadminboard'])->name('admin.deleteadminboard');
Route::post('/admin/contentssort', [ContentsadminController::class, 'contentssort'])->name('admin.contentssort');
Route::post('/admin/commentsearch', [ContentsadminController::class, 'commentsearch'])->name('admin.commentsearch');

Route::get('/admin/user', [AdminController::class, 'adminuser'])->name('admin.usermanagement');
Route::delete('/admin/userdestroy', [AdminController::class, 'userdestroy'])->name('admin.userdestroy');
Route::match(['get', 'post'],'/admin/searchUsers', [AdminController::class, 'searchUsers'])->name('admin.searchUsers');
Route::get('/admin/symptomsmanagement', [AdminController::class, 'symptomsmng'])->name('admin.symptomsmanagement');
Route::match(['get', 'post'],'/admin/searchsymptoms', [AdminController::class, 'searchsymptoms'])->name('admin.searchsymptoms');
Route::delete('/admin/symptomdestroy', [AdminController::class, 'symptomdestroy'])->name('admin.symptomdestroy');
Route::post('/addsymptom', [AdminController::class, 'addsymptom'])->name('admin.addsymptom');











    // 템플릿 라우트
    Route::get('/admin/charts-chartjs', function () {
        return view('/adminpage/charts-chartjs');
    })->name('charts-chartjs');
    
    Route::get('/admin/icons-feather', function () {
        return view('/adminpage/icons-feather');
    })->name('icons-feather');
    
    Route::get('/admin/blank', function () {
        return view('/adminpage/blank');
    })->name('blank');
    
    Route::get('/admin/pages-sign-in', function () {
        return view('/adminpage/pages-sign-in');
    })->name('pages-sign-in');
    
    Route::get('/admin/pages-sign-up', function () {
        return view('/adminpage/pages-sign-up');
    })->name('pages-sign-up');
    
    Route::get('/admin/ui-buttons', function () {
        return view('/adminpage/ui-buttons');
    })->name('ui-buttons');
    
    Route::get('/admin/ui-cards', function () {
        return view('/adminpage/ui-cards');
    })->name('ui-cards');
    
    Route::get('/admin/ui-forms', function () {
        return view('/adminpage/ui-forms');
    })->name('ui-forms');
    
    Route::get('/admin/ui-typography', function () {
        return view('/adminpage/ui-typography');
    })->name('ui-typography');
    
    Route::get('/admin/upgrade-to-pro', function () {
        return view('/adminpage/upgrade-to-pro');
    })->name('upgrade-to-pro');
    
    Route::get('/admin/board', function () {
        return view('/adminpage/upgrade-to-pro');
    })->name('upgrade-to-pro');

});

