<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Controllers\Api
 * 파일명     : ApiUsersController.php
 * 이력       : 0615 new KMH
 *              0720 add KMJ
 * *********************************** */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\CertificationEmail;
use Illuminate\Http\Request;
use App\Models\Userchks;
use App\Models\Users;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ApiUsersController extends Controller
{

    public function getUserChk($email){ // 0720 KMJ add
        $user=DB::table('users')->where('user_email',$email)->first();
        // 유저가 있을 경우
        if(!$user){
            // user가 없을 경우 성공
            $arr['errorcode']="0";
            $arr['msg']="인증번호가 발송되었습니다.";
            // $arr['msg']="사용가능한 이메일 입니다.";
            $this->insertMailChk($email);
        } else{
            $arr['errorcode']="E01";
            $arr['msg'] = "이미 사용중인 이메일 입니다.";
        }
        return response()->json($arr,Response::HTTP_OK);
    }

    // public function getUserChk($email){ // 0720 KMJ del
    //     $user=DB::table('users')->where('user_email',$email)->first();
    //     // user가 없을 경우 성공
    //     $arr['errorcode']="0";
    //     $arr['msg']="인증번호가 발송되었습니다.";
    //     // $arr['msg']="사용가능한 이메일 입니다.";
    // // 유저가 있을 경우
    //     if($user){
    //         $arr['errorcode']="E01";
    //         $arr['msg'] = "이미 사용중인 이메일 입니다.";
    //     }
    //     return response()->json($arr,Response::HTTP_OK);
    //     // return $arr;

    // }

    public function insertMailChk($email){
        $num ='';
        // 메일보내기
        for ($i=0; $i < 8; $i++) { 
            $num .= random_int(0, 9);
        }
        $time = Carbon::now()->addMinutes(10);

        // 인증 메일 보내고 난 후 재발송 했을 경우 이전의 인증 번호 못 쓰게 처리
        DB::table('userchks')
            ->where('email', '=', $email)
            ->update(['chk_flg' => '2']);

        $userchks = new Userchks;
        $userchks->email = $email;
        $userchks->chk_num = $num;
        $userchks->time_deadline = $time;
        $userchks->save();
        Mail::to($email)->send(new CertificationEmail($num));
    } // 0720 KMJ add

    public function getMailChk(Request $req){        
        // $chk = DB::table('userchks')
        //                 ->where('email', $req->email)
        //                 ->where('chk_num', $req->chk_num)
        //                 ->where('chk_flg', '0')
        //                 ->where('time_deadline', '>', Carbon::now())
        //                 ->get();
        $date = Carbon::now();
        $chk = DB::table('userchks')
        ->where('email', $req->email)
        ->where('chk_num', $req->chk_num)
        ->where('chk_flg', '0')
        ->where('time_deadline', '>', $date)
        ->update(['chk_flg' => '1', 'updated_at' => $date]);
        // $chk = Userchks::where('email', $req->email)
        //                 ->where('chk_num', $req->chk_num)
        //                 ->where('chk_flg', '0')
        //                 ->where('time_deadline', '>', Carbon::now())
        //                 ->get();
        // $sql = "UPDATE userchks SET chk_flg = ? WHERE email = ? AND chk_flg = ? AND chk_num = ?";
        // $prepare = [ 'chk_flg' => '1', 'email' => $req->email, 'chk_num' => $req->chk_num];
        // $chk = DB::update($sql, $prepare);
        if ($chk) {
            // $query = "UPDATE userchks SET chk_flg = '1' WHERE email = ? AND chk_flg = '0' AND chk_num = ? and 'time_deadline' > ? ";
            // $prepare = ['email' => $req->email, 'chk_num' => $req->chk_num, Carbon::now()];
            // $result = DB::update($query,$prepare);
            // $chk->chk_flg = "1";
            // $chk->save();
            // DB::table('userchks')
            //     ->where('email', $req->email)
            //     ->where('chk_num', $req->chk_num)
            //     ->where('chk_flg', '0')
            //     ->where('time_deadline', '>', Carbon::now())
            //     ->update(['chk_flg' => '1']);

            $arr['errorcode']="0";
            $arr['msg'] = "올바른 인증번호 입니다.";

        } else {
            $arr['errorcode']="E02";
            $arr['msg'] = "유효한 인증번호가 아닙니다.";
        }
        return response()->json($arr,Response::HTTP_OK);
        // Mail::to($req->email)->send(new CertificationEmail($num));
        // INSERT INTO userchks(email, chk_num, time_deadline)
        // Mail::to($email)->send(new FindPassword($pw));
        // Mail::send('emailchk');
    } // 0720 KMJ add
}
