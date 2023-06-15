<?php

use App\Http\Controllers\HanoksController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UsersInfoController;
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

// 0613 KMH new
// 로그인 
Route::get('/users/login',[UsersController::class,'login'])->name('users.login');
Route::post('/users/loginpost',[UsersController::class,'loginpost'])->name('users.login.post');
//회원가입
Route::get('/users/regist',[UsersController::class,'regist'])->name('users.regist');
Route::post('/users/registpost',[UsersController::class,'registpost'])->name('users.regist.post');

// // 비밀번호 찾기
// Route::get('/users/findPw',[UsersController::class,'findPw'])->name('users.findPw');
// Route::post('/users/findPwpost',[UsersController::class,'findPwpost'])->name('users.findPw.post');
// // 아이디 찾기 
// Route::get('/users/findId',[UsersController::class,'findId'])->name('users.findId');
// Route::post('/users/findIdpost',[UsersController::class,'findIdpost'])->name('users.findId.post');
// 임시비밀번호발송페이지 
// Route::get('/users/alertFindPw',[UsersController::class,'alertFindPw'])->name('users.alert.findPw'); // 0614 del KMH
// 아이디찾기알림페이지
// Route::get('/users/alertFindId',[UsersController::class,'alertFindId'])->name('users.alert.findId'); // 0614 del KMH
//0613 KMH new end***********************************************
// 숙소 상세 페이지 0614 KMJ add
Route::get('/hanoks/detail/{id}',[HanoksController::class,'hanoksDetail'])->name('hanoks.detail');

// 0613 YSH new
// 회원 정보 페이지(내 예약)
Route::get('/users/information/reserve',[UsersInfoController::class,'reserveInfo'])->name('users.information.reserve');
// 회원 정보 페이지(찜)
Route::get('/users/information/dibs',[UsersInfoController::class,'dibsInfo'])->name('users.information.dibs');
// 회원 정보 페이지(회원 정보)
Route::get('/users/information/info',[UsersInfoController::class,'info'])->name('users.information.info');
// 회원 정보 수정페이지
Route::get('/users/information/info/edit',[UsersInfoController::class,'infoedit'])->name('users.information.info.edit');
Route::post('/users/information/info/editpost',[UsersInfoController::class,'infoeditpost'])->name('users.information.info.edit.post');
// 회원 정보 페이지(리뷰)
Route::get('/users/information/review',[UsersInfoController::class,'reviewInfo'])->name('users.information.review');
// 회원 정보 탈퇴 페이지
Route::get('/users/information/unregist',[UsersInfoController::class,'unregist'])->name('users.unregist');
// YSH new end***********************************************

// 0615 BYJ new
// 리뷰 작성 페이지
Route::get('/users/reviewinsert',[ReviewController::class,'reviewinsert'])->name('users.review');
Route::post('/users/reviewpost',[ReviewController::class,'reviewpost'])->name('users.review.post');