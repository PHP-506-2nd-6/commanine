<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : controllers
 * 파일명     : UsersInformationController.php
 * 이력       : 0613 new ysh
 * *********************************** */

namespace App\Http\Controllers;

use App\Models\Reservations;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Symfony\Component\VarDumper\VarDumper;

class UsersInfoController extends Controller
{
    // 내 예약 정보 출력 페이지
    public function reserveInfo() {
        // $users = Users::find(Auth::User()->id); // 로그인된 id의 레코드 가져오는 방법
        $users = Reservations::find(Auth::User()->user_id);
        return view('informationreserve')->with('data', $users);

        // 로그인 안되었을 시 로그인 페이지 리다이렉트
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }
    }
    // 내 찜 정보 출력 페이지
    public function dibsInfo() {
        $users = Reservations::find(Auth::User()->user_id);
        return view('informationdibs')->with('data', $users);

        if(auth()->guest()) {
            return redirect()->route('users.login');
        }
    }
    // 내 회원 정보 출력 페이지
    public function info() {
        $users = Users::find(Auth::User()->user_id);
        return view('informationinfo')->with('data', $users);
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }
    }
    // 내 리뷰 정보 출력 페이지
    public function reviewInfo() {
        $users = Users::find(Auth::User()->user_id);
        return view('informationreview')->with('data', $users);

        if(auth()->guest()) {
            return redirect()->route('users.login');
        }
    }
    // 회원 정보 수정 페이지 출력
    public function infoedit() {
        $users = Users::find(Auth::User()->user_id);
        return view('informationinfoedit')->with('data', $users);

        if(auth()->guest()) {
            return redirect()->route('users.login');
        }
    }
    // 회원 정보 업데이트
    public function infoeditpost(Request $req) {
        $arrKey = [];
        $baseUser = Users::find(Auth::User()->user_id);
        if($req->user_num !== $baseUser->user_num) {
            $arrKey[] = 'user_num';
        }
        if(isset($req->user_pw)) {
            $arrKey[] = 'user_pw';
        }
        $chkList = [
            'user_num' => 'required|regex:/^[0-9]{3}[0-9]{4}[0-9]{4}$/'
            , 'user_pw' => 'same:user_pwchk|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/'
        ];
        foreach($arrKey as $val) {
            $arrChk[$val] = $chkList[$val];
        }
        // var_dump($req, $arrKey, $arrChk, $chkList);
        // exit;
        if(isset($arrChk)) {
            $req->validate($arrChk);
            foreach($arrKey as $val) {
                if($val === 'user_pw') {
                    $baseUser->$val = Hash::make($req->$val);
                    continue;
                }
                $baseUser->$val = $req->$val;
            }
            $baseUser->save();
            if(in_array('user_pw',$arrKey)) {
                Session::flush();
                Auth::logout();
                return redirect()->route('users.login');
            }
            return redirect()->route('users.information.info');
        }

        if(empty($arrKey)) {
            return redirect()->back()->with('error', '전화번호 및 비밀번호를 변경후 눌러 주시기 바랍니다');
        }
        // return redirect()->route('users.information.info.edit');
        return redirect()->back();
    }
    // 회원 탈퇴 시 비밀번호 재확인 페이지
    public function unregistPwChk() {
        return view('pwcert')->with('data',1);
    }
    // 회원 정보페이지 갈 때 비밀번호 재확인
    public function infoPwChk() {
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }
        return view('pwcert')->with('data',0);
    }
    // 비밀번호 재확인->회원 탈퇴 페이지 이동
    public function unregistPwChkpost(Request $req) {
        if($req->pw_flg === "1") {
            $req->validate([
                'user_pw' => 'regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/'
            ]);
            $baseUser = Users::find(Auth::User()->user_id);
            if(!$baseUser || !(Hash::check($req->user_pw, $baseUser->user_pw))) {
                $error = '비밀번호를 다시한번 확인해 주세요.';
                return redirect()->back()->with('error',$error);
            }
            return view('informationunregist');
        }
        // 회원 정보 페이지 이동
        if($req->pw_flg === "0") {
            $req->validate([
                'user_pw' => 'regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/'
            ]);
            $baseUser = Users::find(Auth::User()->user_id);
            if(!$baseUser || !(Hash::check($req->user_pw, $baseUser->user_pw))) {
                $error = '비밀번호를 다시한번 확인해 주세요.';
                return redirect()->back()->with('error',$error);
            }
            return view('informationinfo')->with('data', $baseUser);
        }
    }
    // 탈퇴 완료후 메인 페이지 이동
    public function unregistComp() {
        $baseUser = Users::find(Auth::User()->user_id);
        $baseUser->delete();
        Session::flush();
        Auth::logout();
        return redirect('/');

    }

}
