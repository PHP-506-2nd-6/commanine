<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : controllers
 * 파일명     : UsersInformationController.php
 * 이력       : 0613 new ysh
 * *********************************** */

namespace App\Http\Controllers;

use App\Models\Reservations;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Symfony\Component\VarDumper\VarDumper;
use Illuminate\Pagination\Paginator;

class UsersInfoController extends Controller
{
    // 내 예약 정보 출력 페이지
    public function reserveInfo() {
        // 로그인 안되었을 시 로그인 페이지 리다이렉트
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }
        // $users = Users::find(Auth::User()->id); // 로그인된 id의 레코드 가져오는 방법
        // $users = Reservations::find(Auth::User()->user_id);
        // return view('informationreserve')->with('data', $users);

        // 0622 BYJ
        // $user_id = Reservations::find(Auth::User()->user_id);
        $user_id = Auth::User()->user_id;
        $query = DB::table('rooms as room')
        ->join('hanoks as han', 'han.id', '=', 'room.hanok_id')
        ->join('reservations as re', 're.room_id', '=', 'room.id')
        ->select('han.id','han.hanok_name', 'han.hanok_img1', 'room.room_name', 'room.room_price', 're.chk_in', 're.chk_out', 're.reserve_adult', 're.user_id', 're.reserve_flg')
        ->where('re.user_id', $user_id)
        ->orderBy('re.id', 'desc')
        ->paginate(2);

        return view('informationreserve')->with('reserve', $query);
        

    }
    
    // 내 찜 정보 출력 페이지
    public function dibsInfo() {
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }
        $users = Reservations::find(Auth::User()->user_id);
        return view('informationdibs')->with('data', $users);

    }
    // 내 회원 정보 출력 페이지
    public function info() {
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }
        $users = Users::find(Auth::User()->user_id);
        return view('informationinfo')->with('data', $users);
    }
    // 내 리뷰 정보 출력 페이지
    public function reviewInfo() {
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }
        $users = Users::find(Auth::User()->user_id);
        return view('informationreview')->with('data', $users);

    }
    // 회원 정보 수정 페이지 출력
    public function infoedit() {
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }
        $users = Users::find(Auth::User()->user_id);
        return view('informationinfoedit')->with('data', $users);

    }
    // 회원 정보 업데이트
    public function infoeditpost(Request $req) {
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }
        $arrKey = [];
        $baseUser = Users::find(Auth::User()->user_id);
        if($req->user_num !== $baseUser->user_num) {
            $arrKey[] = 'user_num';
        }
        if(isset($req->user_pw)) {
            $arrKey[] = 'user_pw';
        }
        $chkList = [
            'user_num' => 'required|regex:/^[0-9]{3}[0-9]{4}[0-9]{4}$/u'
            , 'user_pw' => 'same:user_pwchk|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/u'
        ];
        foreach($arrKey as $val) {
            $arrChk[$val] = $chkList[$val];
        }
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
                // echo "<script>alert('비밀번호가 변경이 완료 되었습니다. 변경한 비밀번호로 다시 로그인 해주세요');</script>";
                return redirect()->route('users.login')->with('success', '변경한 비밀번호로 재로그인 해주세요');
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
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }
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
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }
        if($req->pw_flg === "1") {
            $req->validate([
                'user_pw' => 'regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/u'
            ]);
            $baseUser = Users::find(Auth::User()->user_id);
            if(!$baseUser || !(Hash::check($req->user_pw, $baseUser->user_pw))) {
                $error = '비밀번호를 다시한번 확인해 주세요.';
                return redirect()->back()->with('error',$error);
            }
            return redirect()->route('users.information.unregist');
        }
        // 회원 정보 페이지 이동
        if($req->pw_flg === "0") {
            $req->validate([
                'user_pw' => 'regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/u'
            ]);
            $baseUser = Users::find(Auth::User()->user_id);
            if(!$baseUser || !(Hash::check($req->user_pw, $baseUser->user_pw))) {
                $error = '비밀번호를 다시한번 확인해 주세요.';
                return redirect()->back()->with('error',$error);
            }
            // return view('informationinfo')->with('data', $baseUser);
            return redirect()->route('users.information.info.edit')->with('data', $baseUser);
        }
    }
    public function unregist(){
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }
        return view('informationunregist');
    }
    // 탈퇴 완료후 메인 페이지 이동
    public function unregistComp() {
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }
        $baseUser = Users::find(Auth::User()->user_id);
        $baseUser->delete();
        Session::flush();
        Auth::logout();
        return redirect('/');

    }

    // 내 리뷰 페이지
    public function myreview() {
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }
        $user_id = Auth::User()->user_id;
        $reviews = DB::table('hanoks as h')
                        ->join('reviews as r', 'r.hanok_id', '=', 'h.id')
                        ->select('r.*', 'h.hanok_name')
                        ->where('r.user_id', '=', $user_id)
                        ->get();
        return view('myreview')->with('review', $reviews);
    }
}