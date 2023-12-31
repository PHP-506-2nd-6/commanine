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
// 임시 비밀번호 변경
Route::get('/users/pwchange', [UsersController::class, 'pwchange'])->name('users.pwchange');
Route::post('/users/pwchangepost', [UsersController::class, 'pwchangepost'])->name('users.pwchange.post');
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
// Route::get('/users/payment/completee',[PaymentController::class,'payComplete'])->name('users.payment.paycomp');

// 0719 YSH new add
// 3차
// 관리자 메인 페이지
Route::get('/admin', [AdminController::class, 'adminRegist'])->name('admin.regist');
// 관리자 로그인 페이지 이동
Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');
// 관리자 로그인 페이지 이동
Route::post('/admin/loginpost', [AdminController::class, 'adminLoginPost'])->name('admin.login.post');
// 관리자 로그아웃 페이지 이동
Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
// 관리자 예약 정보 이동 byj
Route::get('/admin/reservation', [AdminController::class, 'adminReservation'])->name('admin.reservation');
Route::get('/admin/reservation/search', [AdminController::class, 'adminReservationSearch'])->name('admin.reservation.search');
// 관리자 예약 정보 수정 add 0724 byj
// Route::get('/admin/reservation/{reserve_id}/edit', AdminController::class,'adminReservationEdit')->name('admin.reservation.edit');
Route::get('/admin/reservation/{reserve_id}', [AdminController::class, 'adminReservationEdit'])->name('admin.reservation.edit');
Route::put('/admin/reservation/{reserve_id}', [AdminController::class,'adminReservationUp'])->name('admin.reservation.up');
// 관리자 리뷰 이동 byj
Route::get('/admin/review', [AdminController::class, 'adminReview'])->name('admin.review');
Route::get('/admin/review/search', [AdminController::class, 'adminReviewSearch'])->name('admin.review.search');
// 관리자 유저 정보 이동
Route::get('/admin/users', [AdminController::class, 'adminUsers'])->name('admin.users');
Route::get('/admin/users/search', [AdminController::class, 'adminUsersSearch'])->name('admin.users.search');

// 관리자 유저 탈퇴
Route::post('/admin/users/unregist/{user_id}', [AdminController::class,'adminUserUnregist'])->name('admin.users.unregist');
// 관리자 유저 정지
Route::post('/admin/users/ban/{user_id}', [AdminController::class,'adminUserBan'])->name('admin.users.ban');
// 관리자 유저 정지 취소
Route::post('/admin/users/cancelban/{user_id}', [AdminController::class,'adminUserCancelBan'])->name('admin.users.cancel.ban');
// 관리자 유저 비밀번호 리셋
Route::post('/admin/users/pwreset/{user_id}', [AdminController::class,'adminUserPwReset'])->name('admin.users.pw.reset');

// 관리자 숙소 정보 이동
Route::get('/admin/hanoks', [AdminController::class, 'adminHanoks'])->name('admin.hanoks');
Route::get('/admin/hanoks/search', [AdminController::class, 'adminHanoksSearch'])->name('admin.hanoks.search');

// 관리자 숙소 상세 이동
Route::get('/admin/hanoks/detail/{hanok_id}', [AdminController::class, 'adminHanoksDetail'])->name('admin.hanoks.detail');

// 관리자 숙소 등록 이동 
Route::get('/admin/hanoks/insert', [AdminController::class, 'adminHanoksInsert'])->name('admin.hanoks.insert');
Route::post('/admin/hanoks/insertPost', [AdminController::class, 'adminHanoksInsertPost'])->name('admin.hanoks.insert.post');

// 관리자 객실 등록 이동
Route::get('/admin/hanoks/Roominsert/{hanok_id}', [AdminController::class, 'adminRoomsInsert'])->name('admin.rooms.insert');
Route::post('/admin/hanoks/RoominsertPost/{hanok_id}', [AdminController::class, 'adminRoomsInsertPost'])->name('admin.rooms.insert.post');

// 관리자 숙소 수정
Route::put('/admin/hanoks/hanokUpdate', [AdminController::class, 'adminHanokUpdate'])->name('admin.hanoks.update');
// 관리자 객실 수정
Route::put('/admin/hanoks/roomUpdate', [AdminController::class, 'adminRoomUpdate'])->name('admin.rooms.update');

// 0722 add
// 관리자 리뷰 수정
Route::put('admin/review/update/{review_id}', [AdminController::class, 'adminReviewUpdate'])->name('admin.review.update');
// 관리자 리뷰 삭제
Route::delete('admin/review/delete/{review_id}', [AdminController::class, 'adminReviewDelete'])->name('admin.review.delete');
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