<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    // use AuthenticatesUsers;

    
    // 카카오 로그인
    // public function redirectToKakao()
    // {
    //     return Socialite::driver('kakao')->redirect();
    // }
    // // 카카오 콜백
    // public function handleKakaoCallback()
    // {
    //     $user = Socialite::driver('kakao')->user();
    //     $this->_registerOrLoginUser($user);

    //     // 로그인 후에 메인
    //     return redirect()->route('/');
    // }

    // protected function _registerOrLoginUser($data) {
    //     $user = Users::where('email', '=', $data->user_email)->first();

    // // if ($existingUser) {
    // //     // 이미 등록된 사용자인 경우 로그인 처리
    // //     Auth::login($existingUser);
    // // } else {
    // //     // 새로운 사용자 등록
    // //     $newUser = new Users();
    // //     $newUser->name = $kakaoUser->name;
    // //     $newUser->email = $kakaoUser->email;
    // //     // 필요한 경우 사용자의 추가 정보를 설정합니다.
    // //     $newUser->save();

    // //     Auth::login($newUser);


    // //     // throw new Exception('등록되지 않은 사용자입니다.');
    // // }

    //     if (!$user) {
    //         $user = new Users();
    //         $user->name = $data->user_name;
    //         $user->email = $data->user_email;
    //         $user->provider_id = $data->id;
    //         $user->save();
    //     }

    // Auth::login($user);
    // }
}

