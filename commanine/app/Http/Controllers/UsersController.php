<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Controller
 * 파일명     : UsersController.php
 * 이력       : 0613 new KMH
 *              0719 add KMJ
 * *********************************** */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Admins;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Mail\CertificationEmail;
use App\Mail\FindPassword;
use App\Models\Userchks;
use App\Rules\birthcase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class UsersController extends Controller
{
    //0613 KMH new
    public function login(){
        return view('login');
    }
    
    //0613 KMH new
    public function loginpost(Request $request){
        // if( $request->session()->has('admin') ) {
        //     $error = '아이디와 비밀번호를 확인해주세요.';
        //     $admin = Admins::where('admin_id', $request->email)->first();
        //     // $user가 존재하지 않거나, 비밀번호가 일치하지 않을 경우
        //     if(!$admin || !($request->password === $admin->admin_pw)){
        //         return redirect()
        //                 ->back()
        //                 ->with('error',$error);
        //     }
        //     Auth::login($admin);
        //     session($admin->only('id','admin_id')); 
        //     session()->forget('admin');
        //     return redirect()->intended(route('admin.regist'));
        // }
        // else{
        $error = '아이디와 비밀번호를 확인해주세요.';
        // 유효성 검사
        $validator = Validator::make(
            $request->only('email','password')
            ,[
                'email'     =>  'required|email|max:50|regex:/^([\w\.\_\-])*[a-zA-Z0-9]+([\w\.\_\-])*([a-zA-Z0-9])+([\w\.\_\-])+@([a-zA-Z0-9]+\.)+[a-zA-Z0-9]{2,8}$/u'
                ,'password'  =>  'required|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/u'
            ]);
        if($validator->fails()){
            return redirect()->back()->with('error',$error);
        }
        // 유저 정보 습득 
        $user = Users::where('user_email',$request->email)->first();
        // $user가 존재하지 않거나, 비밀번호가 일치하지 않을 경우
        if(!$user || !(Hash::check($request->password, $user->user_pw))){
            // if(!$user || !($request->password === $user->user_pw)){
            return redirect()
                    ->back()
                    ->with('error',$error);
        }
        Auth::login($user);
        if(Auth::check()){
            session($user->only('user_id','user_name'));

            if ($user->pw_flg == "1") { // 임시 비밀번호로 로그인 했을 경우 임시 비밀번호 변경 페이지로 이동
                return redirect()->route('users.pwchange');
            }
            return redirect()->intended(route('main'));
        }else{
            $error = '유저 인증 작업 에러. 잠시 후에 다시 입력해 주세요';
            return redirect()->back()->with('error',$error);
        }
    }

    public function pwchange(){
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }
        return view('pwchange');
    }

    public function pwchangepost(Request $req){
        $validator = Validator::make(
            $req->only('password', 'passwordChk')
            ,[
                'password'  =>  'required_with:passwordchk|same:passwordChk|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/u'
                ,'passwordChk' => 'required|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/u'
            ]
            );
        $user = Users::find(Auth::User()->user_id);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->user_pw = Hash::make($req->password);
        $user->pw_flg = "0";
        $user->save();
        return redirect()
                ->route('main');
    }

    //0613 KMH new
    public function regist(){
        return view('regist');
    }
    //0613 KMH new
    public function registpost(Request $request){

        // 유효성 검사 
        $validator = Validator::make(
            $request->only('name','phoneNumber','email','password','passwordChk','birth','question','questAnswer')
            ,[
                'name'     => 'required|max:30|regex:/^[가-힣]{2,30}$/u'
                ,'email'     =>  'required|email|regex:/^([\w\.\_\-])*[a-zA-Z0-9]+([\w\.\_\-])*([a-zA-Z0-9])+([\w\.\_\-])+@([a-zA-Z0-9]+\.)+[a-zA-Z0-9]{2,8}$/u'
                ,'password'  =>  'required_with:passwordchk|same:passwordChk|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/u'
                ,'passwordChk' => 'required|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/u'
                ,'birth'    =>['required',new birthcase]
                ,'phoneNumber' =>'required|regex:/^[0-9]{3}[0-9]{4}[0-9]{4}$/u'
                ,'question' =>'required'
                ,'questAnswer'=>'required|max:30|regex:/^[ㄱ-ㅎ가-힣a-zA-Z0-9]{2,30}$/u'
            ]
        ,$message =[
            'required'          => ':attribute은(는) 필수항목 입니다.'
            ,'name.max'         => '이름은 최대 30자 입니다.'
            ,'name.regex'       => '이름은 한글로 2~30자 입력해 주세요.'
            ,'password.same'    => '비밀번호 확인과 일치해야 합니다.'
            ,'password.regex'   => '영어,숫자,특수문자를 8~20글자 입력하세요.'
            ,'phoneNumber.regex'    => '전화번호를 형식에 맞게 입력해 주세요.'
            ,'questAnswer.max'      =>  '답은 최대 30자 입니다.'
            ,'questAnswer.regex'    => '답은 한글,숫자,영어로 2~30자만 입력해주세요.'
        ]);
        
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // return $request->all();
        $data['user_name']   = $request->input('name');
        $data['user_email']  = $request->input('email');
        // 비밀번호 해시화
        $data['user_pw'] = Hash::make($request->input('password'));
        $data['user_birth'] = $request->input('birth');
        $data['user_num'] = $request->input('phoneNumber');

        $data['user_que'] = $request->input('question');
        $data['user_an'] = $request->input('questAnswer');

        // 인증 테이블에 이 유저가 인증을 했는지 확인.(메일 인증 후 다른 이메일 입력하여 가입하려고 했을 때 막는 처리)
        $userChk = DB::table('userChks')->
                            where('email',$request->email)
                            ->where('chk_num', $request->emailChkNum)
                            ->where('chk_flg', '1')->orderBy('id', 'desc')
                            ->limit(1)->get();
        // Log::debug('유저체크',$userChk);
        // Log::debug('유저체크', $userChk);
        // return var_dump($userChk);
        if ($userChk) { // 인증 된 유저면 가입
            $user = Users::create($data);   // insert 
        }
        // return var_dump($user->user_email);
        if(!$user){
            $error = '잠시 후에 다시 시도해 주세요';
            return redirect()
                    ->route('users.regist')
                    ->with('error',$error);
        }
        // $user = new Users();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // Mail::to($data['user_email'])->send(new CertificationEmail($data));
        // return var_dump($user);
        // 회원가입 완료 로그인 페이지 이동
        return redirect()
                ->route('users.login')
                ->with('success','회원가입을 완료했습니다.');
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
                
        //         'email'     =>  'required|email|max:50|regex:/^([\w\.\_\-])*[a-zA-Z0-9]+([\w\.\_\-])*([a-zA-Z0-9])+([\w\.\_\-])+@([a-zA-Z0-9]+\.)+[a-zA-Z0-9]{2,8}$/u'
        //         ,'phoneNumber' =>'required|regex:/^[0-9]{3}[0-9]{4}[0-9]{4}$/u'
        //         ,'question' =>'required'
        //         // 질문의 답 
        //         ,'questAnswer'=>'required|max:30|regex:/^[ㄱ-ㅎ가-힣a-zA-Z0-9]{2,30}$/u'
        //     ]);
        // if($validator->fails()){
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
        // 유저 정보 가져와서 
        $user = Users::where('user_email',$request->email)
                    ->where('user_num',$request->phoneNumber)
                    ->where('user_que',$request->question)
                    ->where('user_an',$request->questAnswer)
                    ->first();
        // 0720 KMJ add

        // $user = Users::where('user_email',$request->email)->first();
        // email, phoneNumber,question, questAnswer이 유저 테이블의 user_email, user_num, user_que,user_an 과 일치하지 않을 경우
        // if((!($user->email === $request->email)&&
        //     !($user->user_num === $request->phoneNumber)&&
        //     !($user->user_que == $request->question)&&
        //     !($user->user_an === $request->questAnswer))){
        //         $error="일치하는 회원 정보가 없습니다";
        //         // 에러 메세지 출력하면서 redirect->back();
        //         return redirect()->back()->with('error',$error);
        // 0720 KMJ del 조건문 버그 발견

        if(!$user){ // 0720 KMJ add 유저 정보 못 가져오면 에러 메세지 뜨도록 수정
                $error="일치하는 회원 정보가 없습니다";
                // 에러 메세지 출력하면서 redirect->back();
                return redirect()->back()->with('error',$error);
            }else{
                // 0719 KMJ add 임시 비밀번호 생성 - 총 10자리의 영어 대소문자, 숫자, 특수문자가 들어가는 비밀번호
                $len = 8;
                $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                $symbols = '!@#$%^*-';
                $random_char = '';
                $random_symbol = $symbols[random_int(0, (mb_strlen($symbols) - 1))];
                $max = mb_strlen($chars) - 1;
                for ($i=0; $i < $len ; $i++) { 
                    $rand_index = random_int(0, $max);
                    $random_char .= $chars[$rand_index];
                }
                // 비밀번호 임의의 자리에 임의의 특수문자 추가
                $pw = substr_replace($random_char, $random_symbol, random_int(0, (mb_strlen($random_char) - 1)), 0);

                // 로그인 정규식 때문에 숫자 안 들어갔을 경우를 대비해서 끝에 무조건 숫자 넣어주기
                $pw .= random_int(0, 9);

                $user->user_pw = Hash::make($pw);
                $user->pw_flg = '1';
                $user->save();
                // 임시 비밀번호 해당 메일로 전송
                Mail::to($request->email)->send(new FindPassword($pw));
                return redirect()->route('users.alert.findPw');
            }
        
    }
    //0613 KMH new
    public function findId(){
        return view('findid');
    }
    //0613 KMH new
    public function findIdpost(Request $request){
        $error="일치하는 회원 정보가 없습니다";
         // 유효성 검사 
        $validator = Validator::make(
            $request->only('name','phoneNumber','question','questAnswer')
            ,[
                'name'     => 'required|max:30|regex:/^[가-힣]{2,30}$/u'
                ,'phoneNumber' =>'required|regex:/^[0-9]{3}[0-9]{4}[0-9]{4}$/u'
                ,'question' =>'required'
                // 질문의 답 
                ,'questAnswer'=>'required|max:30|regex:/^[ㄱ-ㅎ가-힣a-zA-Z0-9]+$/u'
            ]);
        if($validator->fails()){
            return redirect()->back()->with('error',$error);
        }
        // 유저 정보 가져와서 
        $user = Users::where('user_name',$request->name)
                    ->where('user_num',$request->phoneNumber)
                    ->where('user_que',$request->question)
                    ->where('user_an',$request->questAnswer)
                    ->first();

        // email, phoneNumber,question, questAnswer이 유저 테이블의 user_email, user_num, user_que,user_an 과 일치하지 않을 경우
        // if((!($user->name === $request->name)&&
        //     !($user->user_num === $request->phoneNumber)&&
        //     !($user->user_que === $request->question)&&
        //     !($user->user_an === $request->questAnswer))){
        //         // 에러 메세지 출력하면서 redirect->back();
        //         return redirect()->back()->with('error',$error);
        // 0720 KMJ del 조건문 버그 발견

        if(!$user){ // 0720 KMJ add 유저 정보 못 가져오면 에러 메세지 뜨도록 수정
                // 에러 메세지 출력하면서 redirect->back();
                return redirect()->back()->with('error',$error);
            }else{
                // 일치할 경우에는 아이디찾기 알림페이지로이동

                // 0719 KMJ add 아이디찾기 알림 페이지로 이메일 데이터 보내기
                $email = $user->user_email;
                if ( ($p=strpos($email,'@'))>3 ){
                    $email = substr_replace($email,str_repeat('*',$l=$p-3),3,$l);
                    // 이메일 아이디 앞글자 세자리만 보여주고 나머지는 *로 표시
                }

                return redirect()->route('users.alert.findId')->with('email',$email);
            }
        // name, phoneNumber,question, questAnswer이 유저 테이블의 user_name, user_num, user_que,user_an 과 일치하지 않을 경우
        // 에러 메세지 출력하면서 redirect->back();
        // 일치할 경우에는 임시비밀번호로 변경하면서 유저의 아이디와 함께 아이디찾기알림페이지로 이동
    }
    //0613 KMH new
    public function alertFindId(){
        return view('alertfindid');
    }
    public function alertFindPw(){
        return view('alertfindpw');
    }
    //0620 BYJ
    public function logout() {
        Session::flush();
        Auth::logout(); 
        return redirect()->route('main');
    }

}