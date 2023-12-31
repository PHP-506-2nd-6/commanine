<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiUsersController;
use App\Http\Controllers\Api\ApiWishlistsController;
use App\Http\Controllers\Auth\SocialController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::post('/users/regist/{email}',[ApiUsersController::class,'getUserChk']);
Route::get('/users/regist/{email}',[ApiUsersController::class, 'getUserChk']);
Route::put('/users/mail/{email}',[ApiUsersController::class,'getMailChk']);
// Route::put('/users/regist/{email}',[ApiUsersController::class,'getMailChk']);
// Route::post('/users/regist/{email}',[ApiUsersController::class, 'getMailChk']);

Route::post('/wishlists/post/{hanok_id}', [ApiWishlistsController::class, 'store']);
Route::delete('/wishlists/delete/{hanok_id}', [ApiWishlistsController::class, 'destroy']);
// Route::post('/wishlist/{hanok_id}', [ApiWishlistsController::class, 'store']);
// Route::delete('/wishlist/{hanok_id}', [ApiWishlistsController::class, 'destroy']);
// Route::get('/wishlist/{hanok_id}', [ApiWishlistsController::class, 'getWishList']);

// 0717 byj
// Route::get('login/kakao', 'Auth\SocialController@SocialController')->name('login.kakao');
// Route::get('login/kakao/callback', 'Auth\SocialController@handleKakaoCallback');

// Route::get('login/kakao', [App\Http\Controllers\Auth\SocialController::class,'SocialController'])->name('login.kakao');
// Route::get('login/kakao/callback', [App\Http\Controllers\Auth\SocialController::class,'handleKakaoCallback']);

// 0719 KMJ
// Route::post('/users/regist/{email}', [ApiUsersController::class, 'postMailChk']);
// Route::post('/users/regist/{email}', [ApiUsersController::class, 'postMailChk']);
