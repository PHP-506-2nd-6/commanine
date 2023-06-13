<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Controller
 * 파일명     : UsersController.php
 * 이력       : 0613 new
 * *********************************** */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Mail\CertificationEmail;
use App\Mail\FindPassword;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    //0613 KMH new
    public function login(){
        return view('login');
    }

    //0613 KMH new
    public function loginpost(Request $request){
        $user = Users::where('email',$request->email)->first();
        // 유효성 검사 
        $validator = Validator::make(
            $request->only('id','email','password')
            ,[
                'id'        => 'required|integer'
                ,'email'     =>  'required|email|max:50|regex:/^([\w\.\_\-])*[a-zA-Z0-9]+([\w\.\_\-])*([a-zA-Z0-9])+([\w\.\_\-])+@([a-zA-Z0-9]+\.)+[a-zA-Z0-9]{2,8}$/'
                ,'password'  =>  'required_with:passwordchk|same:passwordchk|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/'
            ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // 유저 정보 습득 
        // email이 request->email과 일치한 첫번째 데이터를 가져오겠다. 
        // $user가 존재하지 않거나, 비밀번호가 일치하지 않을 경우
        // (Hash::check($request->password, $user->password) : 해시화된 비밀번호와 요청된 비밀번호 체크
        if(!$user || !(Hash::check($request->password, $user->password))){
            $error = '아이디와 비밀번호를 확인해 주세요.';
            return redirect()
                    ->back()
                    ->with('error',$error);
        }
        Auth::login($user);// 알아서 토큰이나 세션을 넣어줌 
        if(Auth::check()){
            session($user->only('id')); // 세션에 인증된 회원 pk 등록
            //intended()는 완전 새로운 redirect이기 때문에 필요없는 데이터는 모두 정리해줌 
            //! 유저 인증 작업을 완료하고 원래 접속하려고한 url에 접속하게 해주고 만약에 실패할 경우 intended()에 있는 url로 이동
            //todo: 메인페이지 이동으로 변경
            return redirect()->intended(route('main'));
        }else{
            $error = '유저 인증 작업 에러. 잠시 후에 다시 입력해 주세요';
            return redirect()->back()->with('error',$error);
        }
    }

    //0613 KMH new
    public function regist(){
        return view('regist');
    }
    //0613 KMH new
    public function registpost(Request $request){
        // 유효성 검사 
        $validator = Validator::make(
            $request->only('id','name','phonNumber','email','chkEmail','password','passwordChk','birth','question','questAnswer')
            ,[
                'id'        => 'required|integer'
                ,'name'     => 'required|'
                ,'phoneNumber' =>'required|'
                ,'email'     =>  'required|email|max:50|regex:/^([\w\.\_\-])*[a-zA-Z0-9]+([\w\.\_\-])*([a-zA-Z0-9])+([\w\.\_\-])+@([a-zA-Z0-9]+\.)+[a-zA-Z0-9]{2,8}$/'
                ,'chkEmail'     =>'required|'
                ,'password'  =>  'required_with:passwordchk|same:passwordChk|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/'
                ,'passwordChk'=>'required|'
                ,'birth'    =>'required|'
                ,'question' =>'required|'
                ,'questAnswer'=>'required|'
            ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }
    //0613 KMH new
    public function findPw(){
        return view('findpw');
    }
    //0613 KMH new
    public function findPwpost(Request $request){
         // 유효성 검사 
        // $validator = Validator::make(
        //     $request->only('email','phoneNumber','question','questAnswer')
        //     ,[
        //         'email'     =>  'required|email|max:50|regex:/^([\w\.\_\-])*[a-zA-Z0-9]+([\w\.\_\-])*([a-zA-Z0-9])+([\w\.\_\-])+@([a-zA-Z0-9]+\.)+[a-zA-Z0-9]{2,8}$/'
        //         ,'phoneNumber' =>'required|'
        //         ,'question' =>'required|'
        //         ,'questAnswer'=>'required|'
        //     ]);
        // if($validator->fails()){
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
        // 유저 정보 가져와서 
        $user = Users::where('user_email',$request->email)->first();
        // email, phoneNumber,question, questAnswer이 유저 테이블의 user_email, user_num, user_que,user_an 과 일치하지 않을 경우
        // if((!($user->email === $request->email)&&
        //     ($user->user_num === $request->phoneNumber)&&
        //     ($user->user_que === $request->question)&&
        //     ($user->user_an === $request->questAnswer))){
        //         $error="작성하신 정보가 일치하지 않습니다";
        //         // 에러 메세지 출력하면서 redirect->back();
        //         return redirect()->back()->with('error',$error);
        //     }else{
                // 일치할 경우에는 임시비밀번호로 변경하면서 임시비밀번호변경알림페이지로 이동
                // $user->user_pw = Str::random(8);
                Mail::to($request->email)->send(new FindPassword($request->email));
                $user->pw_flg = '1';
                Hash::make($user->user_pw);
                $user->save();
                return redirect()->route('users.login');
            }
        

    //0613 KMH new
    public function findId(){
        return view('findid');
    }
    //0613 KMH new
    public function findIdpost(Request $request){
         // 유효성 검사 
        $validator = Validator::make(
            $request->only('name','phoneNumber','question','questAnswer')
            ,[
                'name'     =>  'required|'
                ,'phoneNumber' =>'required|'
                ,'question' =>'required|'
                ,'questAnswer'=>'required|'
            ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // 유저 정보 가져와서 
        $user = Users::where('email',$request->email)->first();
        // email, phoneNumber,question, questAnswer이 유저 테이블의 user_email, user_num, user_que,user_an 과 일치하지 않을 경우
        if((!($user->name === $request->name)&&
            ($user->user_num === $request->phoneNumber)&&
            ($user->user_que === $request->question)&&
            ($user->user_an === $request->questAnswer))){
                $error="작성하신 정보가 일치하지 않습니다";
                // 에러 메세지 출력하면서 redirect->back();
                return redirect()->back()->with('error',$error);
            }else{
                // 일치할 경우에는 임시비밀번호로 변경하면서 임시비밀번호변경알림페이지로 이동
                $findId=$user->email;
                return redirect()->route('users.alert.findId')->with('findId',$findId);
            }
        // name, phoneNumber,question, questAnswer이 유저 테이블의 user_name, user_num, user_que,user_an 과 일치하지 않을 경우
        // 에러 메세지 출력하면서 redirect->back();
        // 일치할 경우에는 임시비밀번호로 변경하면서 유저의 아이디와 함께 아이디찾기알림페이지로 이동
    }
    //0613 KMH new
    public function alertFindId(){
        return view('alertfindid');
    }
    //0613 KMH new
    public function alertFindPw(){
        return view('alertfindpw');
    }

}
