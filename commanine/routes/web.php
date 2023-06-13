<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
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

// 0613 KMH new
// 로그인 
Route::get('/users/login',[UsersController::class,'login'])->name('users.login');
Route::post('/users/loginpost',[UsersController::class,'loginpost'])->name('users.login.post');
//회원가입
Route::get('/users/regist',[UsersController::class,'regist'])->name('users.regist');
Route::post('/users/registpost',[UsersController::class,'registpost'])->name('users.regist.post');
// 비밀번호 찾기
Route::get('/users/findPw',[UsersController::class,'findPw'])->name('users.findPw');
Route::post('/users/findPwpost',[UsersController::class,'findPwpost'])->name('users.findPw.post');
// 아이디 찾기 
Route::get('/users/findId',[UsersController::class,'findId'])->name('users.findId');
Route::post('/users/findIdpost',[UsersController::class,'findIdpost'])->name('users.findId.post');
// 임시비밀번호발송페이지 
Route::get('/users/alertFindPw',[UsersController::class,'alertFindPw'])->name('users.alert.findPw');
// 아이디찾기알림페이지
Route::get('/users/alertFindId',[UsersController::class,'alertFindId'])->name('users.alert.findId');
//0613 KMH new end***********************************************