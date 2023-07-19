<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Controllers\Api
 * 파일명     : ApiUsersController.php
 * 이력       : 0615 new KMH
 * *********************************** */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\CertificationEmail;
use Illuminate\Http\Request;
use App\Models\Userchks;
use App\Models\Users;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ApiUsersController extends Controller
{
    public function getUserChk($email){
        $user=DB::table('users')->where('user_email',$email)->first();
        // user가 없을 경우 성공
        $arr['errorcode']="0";
        $arr['msg']="사용가능한 이메일 입니다.";
    // 유저가 있을 경우
        if($user){
            $arr['errorcode']="E01";
            $arr['msg'] = "이미 사용중인 이메일 입니다.";
        }
        return response()->json($arr,Response::HTTP_OK);
        // return $arr;

    }
    public function postMailChk($email){
        // $mailData = array(
        //     'a' => $a
        //     ,'b' => $b
        // );
        $code ='';
        // 메일보내기
        for ($i=0; $i <= 6; $i++) { 
            $code .= random_int(0, 10);
        }
        // Mail::to($email)->send(new FindPassword($pw));
        // Mail::send('emailchk');
    }

}
