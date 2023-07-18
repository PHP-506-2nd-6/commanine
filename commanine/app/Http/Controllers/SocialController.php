<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Controller
 * 파일명     : SocialController.php
 * 이력       : 0718 new BYJ 2nd
 * *********************************** */
namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    // 카카오 로그인
    public function redirectToKakao()
    {
        return Socialite::driver('kakao')->redirect();
    }
    // 카카오 콜백
    public function handleKakaoCallback()
    {
        $user = Socialite::driver('kakao')->user();

        $email = $user->getEmail();
        $userModel = Users::where('user_email', $email)->first();

        // $kakaoId = $user->getId();
        $username = "백백";
        $birth = "000808";
        $password = "password123!";
        $num = "01011112222";
        $que = "1";
        $an = "없음";

    //     $userModel = Users::where('user_email', $email)->first();
    //     // return var_dump($userModel);

    if (!$userModel) {
        // 사용자가 존재하지 않으면 새로운 사용자로 등록
        $userModel = new Users();
        $userModel->user_email = $email;
        $userModel->user_name = $username;
        $userModel->user_birth = $birth;
        $userModel->user_pw = Hash::make($password);
        $userModel->user_num = $num;
        $userModel->user_que = $que;
        $userModel->user_an = $an;
        $userModel->save();
    }

    // 사용자를 로그인 처리
    Auth::login($userModel);
    
    if(Auth::check()){
        session(['user_name' => $username]);
        return redirect()->route('main');
    }

        // return view('kakaologin', compact('email'));
        return redirect()->route('main');

        // return $user->getEmail();
        // test
        // $this->_registerOrLoginUser($user);

        // 로그인 후에 메인
        // return redirect()->route('/');
    }

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
