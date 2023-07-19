<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HanoksController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UsersInfoController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SocialController;

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

Route::get('/',[HanoksController::class,'hanoksMain'])->name('main');
// 한옥소개 페이지 add 0718 2n byj
Route::get('/intro',[HanoksController::class,'introHanok'])->name('intro');

// 카카오 로그인 add 0717 2n byj
// Route::get('login/kakao', [SocialController::class,'redirectToKakao'])->name('login.kakao');
// Route::get('login/kakao/callback', [SocialController::class,'handleKakaoCallback']);

Route::get('login/kakao', [SocialController::class,'redirectToKakao'])->name('login.kakao');
Route::get('login/kakao/callback', [SocialController::class,'handleKakaoCallback']);

// 0613 KMH new
// 로그인 
Route::get('/users/login',[UsersController::class,'login'])->name('users.login');
Route::post('/users/loginpost',[UsersController::class,'loginpost'])->name('users.login.post');
//회원가입
Route::get('/users/regist',[UsersController::class,'regist'])->name('users.regist');
Route::post('/users/registpost',[UsersController::class,'registpost'])->name('users.regist.post');

// // 비밀번호 찾기
Route::get('/users/findPw',[UsersController::class,'findPw'])->name('users.findPw');
Route::post('/users/findPwpost',[UsersController::class,'findPwpost'])->name('users.findPw.post');
// // 아이디 찾기 
Route::get('/users/findId',[UsersController::class,'findId'])->name('users.findId');
Route::post('/users/findIdpost',[UsersController::class,'findIdpost'])->name('users.findId.post');
// 임시비밀번호발송페이지 
Route::get('/users/alertFindPw',[UsersController::class,'alertFindPw'])->name('users.alert.findPw'); // 0614 del KMH
// 아이디찾기알림페이지
Route::get('/users/alertFindId',[UsersController::class,'alertFindId'])->name('users.alert.findId'); // 0614 del KMH
//0613 KMH new end***********************************************
// 0616 KMH add
Route::get('/research/page',[ResearchController::class,'researchPage'])->name('research.page');
Route::get('/research/pageget',[ResearchController::class,'researchPageget'])->name('research.page.get');
//0616 KMH add end********************************************
// 숙소 상세 페이지 0614 KMJ add
Route::get('/hanoks/detail/{id}',[HanoksController::class,'hanoksDetail'])->name('hanoks.detail');

// 0613 YSH new
// 회원 정보 페이지(내 예약)
Route::get('/users/information/reserve',[UsersInfoController::class,'reserveInfo'])->name('users.information.reserve');
// // 회원 정보 페이지(찜)
Route::get('/users/information/dibs',[UsersInfoController::class,'dibsInfo'])->name('users.information.dibs');
// 회원 정보 페이지(회원 정보)
Route::get('/users/information/info',[UsersInfoController::class,'info'])->name('users.information.info');
// 회원 정보 수정페이지
Route::get('/users/information/info/edit',[UsersInfoController::class,'infoedit'])->name('users.information.info.edit');
Route::post('/users/information/info/editpost',[UsersInfoController::class,'infoeditpost'])->name('users.information.info.edit.post');
// 회원 정보 페이지 갈때 비밀번호 확인 페이지
Route::get('users/information/pwchk',[UsersInfoController::class,'infoPwChk'])->name('users.information.pwchk');
// // 회원 정보 페이지(리뷰)
// Route::get('/users/information/review',[UsersInfoController::class,'reviewInfo'])->name('users.information.review');
// 회원 정보 수정->탈퇴 처리시 비밀 번호 확인 페이지
Route::get('/users/information/unregist/pwchk',[UsersInfoController::class,'unregistPwChk'])->name('users.unregist.pwchk');
Route::post('/users/information/unregist/pwchkpost',[UsersInfoController::class,'unregistPwChkpost'])->name('users.unregist.pwchk.post');
// 회원 정보 탈퇴 페이지
Route::get('/users/information/unregist',[UsersInfoController::class,'unregist'])->name('users.information.unregist');
// 회원 정보 탈퇴 완료 시키는 페이지
Route::post('/users/information/unregist/complete',[UsersInfoController::class,'unregistComp'])->name('users.information.unregist.comp');
// 결제 페이지
Route::get('/users/payment',[PaymentController::class,'payInfo'])->name('users.payment');
// 결제 완료 페이지
Route::post('/users/payment/complete',[PaymentController::class,'payInfopost'])->name('users.payment.comp');
// 0719 YSH new add
// 3차
// 관리자 메인 페이지
Route::get('/admin', [AdminController::class, 'adminRegist'])->name('admin.regist');
// 관리자 로그인 페이지 이동
Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');
// 관리자 로그아웃 페이지 이동
Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
// 관리자 예약 정보 이동
Route::get('/admin/reservation', [AdminController::class, 'adminReservation'])->name('admin.reservation');
// 관리자 리뷰 이동
Route::get('/admin/review', [AdminController::class, 'adminReview'])->name('admin.review');
// 관리자 유저 정보 이동
Route::get('/admin/users', [AdminController::class, 'adminUsers'])->name('admin.users');
// 관리자 숙소 정보 이동
Route::get('/admin/hanoks', [AdminController::class, 'adminHanoks'])->name('admin.hanoks');
// YSH new end***********************************************

// 0615 BYJ new
// 리뷰 작성 페이지
Route::get('/users/reviewinsert',[ReviewController::class,'reviewinsert'])->name('users.review');
Route::post('/users/reviewpost',[ReviewController::class,'reviewpost'])->name('users.review.post');
// 0620 BYJ
Route::get('/users/logout', [UsersController::class, 'logout'])->name('users.logout');
// 내 리뷰 페이지 0626 KMJ add
Route::get('/users/review', [ReviewController::class, 'review'])->name('users.information.review');
// 리뷰 삭제
Route::post('/users/deletereview/{rev_id}', [ReviewController::class, 'deleteReview'])->name('users.information.review.delete');

Route::get('/checkDataAndRedirect', [ReviewController::class, 'checkDataAndRedirect'])->name('check-data-and-redirect');

// 리뷰 수정
Route::get('/users/review/edit/{rev_id}', [ReviewController::class, 'reviewEdit'])->name('users.review.edit');
Route::post('/users/review/editpost/{rev_id}', [ReviewController::class, 'reviewEditPost'])->name('users.review.edit.post');