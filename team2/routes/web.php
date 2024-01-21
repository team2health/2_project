<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\HashTagController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ContentsadminController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Middleware\Adminauth;
use App\Http\Middleware\Adminblock;
use App\Http\Middleware\Regist;

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
Route::middleware('regist.get')->get('/registpage/{email?}', [UserController::class, 'registpageget'])->name('registpage.get');
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
Route::post('/hashtagcheck', [MypageController::class, 'hashtagcheck']);

Route::post('/namechange', [MypageController::class, 'namechangepost']);
Route::post('/userinfoupdate', [MypageController::class, 'userinfoupdatepost']);
Route::post('/userimgremove', [MypageController::class, 'userimgremovepost']);

Route::get('/timeline', [MypageController::class, 'todaytimelineget'])->name('todaytimeline.get');
Route::post('/daytimeline', [MypageController::class, 'daytimelinepost'])->name('daytimeline.post');
Route::post('/recorddelete', [MypageController::class, 'recorddelete'])->name('recorddelete.post');

Route::get('/seeyouagain', [MypageController::class, 'seeyouagainget'])->name('seeyouagain');


// 이메일 확인 페이지 접속
Route::get('/emailchk', [MailController::class, 'emailchkget'])->name('email.get');
Route::post('/emailchkgo', [MailController::class, 'emailchkpost'])->name('email.post');
Route::post('/emailchkset', [MailController::class, 'emailchkset'])->name('emailchk.post');

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
Route::delete('/admin/pandemicdelete', [AdminController::class, 'pandemicdelete']);
Route::post('/admin/pandemicinsert', [AdminController::class, 'pandemicinsertpost']);
Route::get('/admin/hashtag', [AdminController::class, 'adminhashtagget'])->name('adminhashtag.get');
Route::delete('/admin/hashtagdelete', [AdminController::class, 'hashtagdelete']);
Route::post('/admin/hashtaginsert', [AdminController::class, 'hashtaginsertpost']);
Route::post('/admin/adminregist', [AdminController::class, 'adminregistpost']);
Route::get('admin/admindelete', [AdminController::class, 'admindeleteget'])->name('admindelete.get');
Route::delete('admin/admindeletego', [AdminController::class, 'admindeletegodelete'])->name('admindeletego.delete');
Route::get('/admin/contents/{date?}', [ContentsadminController::class, 'admincontents'])->name('admin.contents');
Route::get('/admin/comments', [ContentsadminController::class, 'admincomments'])->name('admin.comments');
Route::get('/admin/comments/{start_date?}/{end_date?}', [ContentsadminController::class, 'admincommentsset'])->name('admin.admincommentsset');

Route::get('/admin/declaration', [ContentsadminController::class, 'contentsdeclaration'])->name('contents.declaration');
Route::get('/admin/commentsdeclaration', [ContentsadminController::class, 'commentsdeclaration'])->name('comments.declaration');
Route::post('/admin/deleteadminboard', [ContentsadminController::class, 'deleteadminboard'])->name('admin.deleteadminboard');
Route::post('/admin/contentssort', [ContentsadminController::class, 'contentssort'])->name('admin.contentssort');
Route::post('/admin/commentsearch', [ContentsadminController::class, 'commentsearch'])->name('admin.commentsearch');
Route::post('/admin/contentsearch', [ContentsadminController::class, 'contentsearch'])->name('admin.contentsearch');
Route::get('/admin/admincontentsset/{align_board?}/{start_date?}/{end_date?}', [ContentsadminController::class, 'admincontentsset'])->name('admin.admincontentsset');
Route::post('/admin/changecategory', [ContentsadminController::class, 'changecategory'])->name('admin.changecategory');
Route::post('/admin/deleteboard', [ContentsadminController::class, 'deleteboard'])->name('admin.deleteboard');
Route::post('/admin/deletecomments', [ContentsadminController::class, 'deletecomments'])->name('admin.deletecomments');
Route::get('/admin/deletedcontentdate', [ContentsadminController::class, 'deletedcontentdate'])->name('admin.deletedcontentdate');
Route::get('/admin/deletedcontent/{align_board?}/{start_date?}/{end_date?}', [ContentsadminController::class, 'deletedcontent'])->name('deletedcontent.get');
Route::post ('/admin/deletedsearch', [ContentsadminController::class, 'deletedsearch'])->name('deletedsearch.post');
Route::post('/admin/deletedcontentsort', [ContentsadminController::class, 'deletedcontentsort'])->name('admin.deletedcontentsort');
Route::post('/admin/temporarilydelete', [ContentsadminController::class, 'temporarilydelete'])->name('temporarilydelete.post');
Route::post('/admin/deletedeclarationboard', [ContentsadminController::class, 'deletedeclarationboard'])->name('deletedeclarationboard.post');
Route::post('/admin/userdeclaration', [ContentsadminController::class, 'userdeclaration'])->name('userdeclaration.post');
Route::post('/admin/boardsoftdelete', [ContentsadminController::class, 'boardsoftdelete'])->name('boardsoftdelete.post');
Route::post('/admin/boardsetshow', [ContentsadminController::class, 'boardsetshow'])->name('boardsetshow.post');
Route::post('/admin/admindeletecomment', [ContentsadminController::class, 'admindeletecomment'])->name('admindeletecomment.post');
Route::post('/admin/setcommentflg', [ContentsadminController::class, 'setcommentflg'])->name('setcommentflg.post');


Route::get('/admin/adminuser', [AdminController::class, 'adminuser'])->name('admin.adminusermanagement');
Route::delete('/admin/adminuserdestroy', [AdminController::class, 'adminuserdestroy'])->name('admin.adminuserdestroy');
Route::match(['get', 'post'],'/admin/adminsearchUsers', [AdminController::class, 'adminsearchUsers'])->name('admin.adminsearchUsers');
Route::get('/admin/adminsymptomsmanagement', [AdminController::class, 'adminsymptomsmng'])->name('admin.adminsymptomsmanagement');
Route::match(['get', 'post'],'/admin/adminsearchsymptoms', [AdminController::class, 'adminsearchsymptoms'])->name('admin.adminsearchsymptoms');
Route::delete('/admin/adminsymptomdestroy', [AdminController::class, 'adminsymptomdestroy'])->name('admin.adminsymptomdestroy');
Route::post('/adminaddsymptom', [AdminController::class, 'adminaddsymptom'])->name('admin.adminaddsymptom');



});