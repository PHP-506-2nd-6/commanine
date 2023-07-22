<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admins;
use App\Models\Rooms;
use App\Models\Hanoks;
use App\Models\Reviews;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function adminRegist() {
        // session(['admin' => 'administrator']);
        return view('adminRegist');
    }
    public function adminLogin() {
        // session(['admin' => 'administrator']);
        return redirect()->route('users.login')->with('flg', 1);
    }
    public function adminLoginPost(Request $request) {
        $error = '아이디와 비밀번호를 확인해주세요.';
            $admin = Admins::where('admin_id', $request->email)->first();
            // $user가 존재하지 않거나, 비밀번호가 일치하지 않을 경우
            if(!$admin || !($request->password === $admin->admin_pw)){
                return redirect()
                        ->back()
                        ->with('error',$error);
            }
            // admins 테이블에 로그인 하기 위해 설정
            Auth::guard('admins')->login($admin);
            session($admin->only('id','admin_id')); 
            // session()->forget('admin');
            return redirect()->intended(route('admin.reservation'));
    }
    public function adminLogout() {
        Session::flush();
        Auth::logout();
        return redirect()->route('admin.regist');
    }
    //0719 KMH add
    public function adminUsers() {
        $users = DB::table('users')
        // ->dd();
        ->paginate(15);
        return view('adminUser')->with('users',$users);
    }
    public function adminUsersSearch(Request $request){
        $users = DB::table('users')->where('user_email','LIKE','%' . $request->users . '%')->orWhere('user_name','LIKE','%' . $request->users . '%')
        // ->dd();
        ->paginate(15);
        return view('adminUser')->with('users',$users);
    }
    // 0719 add end KMH

    // 0720 add KMH
    public function adminHanoks(){
        // 쿼리
        // SELECT
        // id,
        // hanok_name,
        // hanok_img1,
        // hanok_addr
        // FROM hanoks han
        $hanoks = DB::table('hanoks')->select('id','hanok_name','hanok_addr','hanok_img1')->paginate(16);
        return view('adminHanok')->with('hanoks',$hanoks);
    }
    // 0720 add end KMH 
    public function adminHanoksInsert(){
        Log::debug("insert");
    return view('adminhanoksinsert');
    }

    // 0720 add KMH 
    public function adminHanoksDetail($hanok_id){
        // 쿼리
        // SELECT *
        // FROM hanoks han
        // where id = hanok_id
        // 숙소 정보 출력
        $hanoks = DB::table('hanoks')->where('id','=',$hanok_id)->get();
        // 현재 숙소가 추가한 객실 출력 
        // select room.+
        // from rooms room
        // join hanoks hanok 
        // on room.hanok_id = hanok.id
        // where hanok.id = $hanok_id
        $rooms = DB::table('rooms as room')
        ->select('room.*')
        ->join('hanoks as hanok','room.hanok_id','=','hanok.id')
        ->where('hanok.id','=',$hanok_id)
        ->paginate(1);
        return view('adminHanokDetail')->with('hanoks',$hanoks[0])->with('rooms',$rooms);
    }
    // 0720 add end KMH


    // 0720 add BYJ
    // 예약관리 정보
    public function adminReservation() {
        //test
        // $reserve = DB::table('reservations')
        // ->orderBy('id','desc')
        // ->paginate(15);

        $reserve = DB::table('rooms as room')
        ->join('hanoks as han', 'han.id', '=', 'room.hanok_id')
        ->join('reservations as re', 're.room_id', '=', 'room.id')
        ->SELECT('re.id as reserve_id','re.reserve_name','re.reserve_num','han.id','han.hanok_name', 'room.room_name', 'room.room_price', 're.chk_in', 're.chk_out', 're.reserve_adult', 're.user_id', 're.reserve_flg','re.created_at')
        // ->where('re.user_id')
        ->orderBy('re.id', 'desc')
        ->paginate(15);
        

        return view('adminReserve')->with('reservations',$reserve);
    }
    // 0721 add BYJ
    // 예약관리 검색
    public function adminReservationSearch(Request $req){
        // test
        // $reserve = DB::table('reservations')->where('id','LIKE','%' . $req->id . '%')->orWhere('reserve_name','LIKE','%' . $req->reserve_name . '%')
        // ->paginate(15);
        // $reserve_id = 25;

        $keyword = $req->input('keyword');
        $searchType = $req->input('searchType');

        $reserve = DB::table('rooms as room')
            ->join('hanoks as han', 'han.id', '=', 'room.hanok_id')
            ->join('reservations as re', 're.room_id', '=', 'room.id')
            ->select('re.id as reserve_id', 're.reserve_name', 're.reserve_num', 'han.id', 'han.hanok_name', 'room.room_name', 'room.room_price', 're.chk_in', 're.chk_out', 're.reserve_adult', 're.user_id', 're.reserve_flg', 're.created_at')
            // ->where('han.hanok_name', 'LIKE', '%' . $keyword . '%')
            ->Where('re.' . $searchType, 'LIKE', '%' . $keyword . '%')
            ->orderBy('re.id', 'desc')
            // ->get();
            ->paginate(15);

        return view('adminReserve')->with('reservations',$reserve);
    }

    // 0720 add KMH
    public function adminRoomsInsert($hanok_id){
        $hanoks = DB::table('hanoks')->select('hanok_name','hanok_addr','id')->where('id','=',$hanok_id)->get();
        return view('adminRoomsInsert')->with('hanoks',$hanoks[0]);
    }
    public function adminRoomsInsertPost($hanok_id,Request $req){
        $error = "모든 사항은 필수 사항 입니다.";
        $validator = Validator::make(
            $req->only('room_name','room_content','room_price','room_min','room_max','chk_in','chk_out','room_detail','room_facility','room_img1','room_img2','room_img3')
            ,[
                'room_name'     => 'required'
                ,'room_content' =>'required'
                ,'room_price' =>'required'
                ,'room_min' =>'required'
                ,'room_max' =>'required'
                ,'chk_in' =>'required'
                ,'chk_out' =>'required'
                ,'room_detail' =>'required'
                ,'room_facility' =>'required'
                ,'room_img1' => ['required']
                ,'room_img2' => ['required']
                ,'room_img3' => ['required']
            ]);
        
        if($validator->fails()){
            return var_dump($validator);
            // return redirect()->back()->with('error',$error);
        }
        // 이미지 저장
        $req->room_img1->store('/img/roomImg');
        $req->room_img2->store('/img/roomImg');
        $req->room_img3->store('/img/roomImg');
        // 이미지 이름 가져오기
        $fileName1 = $req->room_img1->hashName();
        $fileName2 = $req->room_img2->hashName();
        $fileName3 = $req->room_img3->hashName();

        
        $data['room_name']   = $req->input('room_name');
        $data['room_content']   = $req->input('room_content');
        $data['room_price']   = $req->input('room_price');
        $data['room_min']   = $req->input('room_min');
        $data['room_max']   = $req->input('room_max');
        $data['chk_in']   = $req->input('chk_in');
        $data['chk_out']  = $req->input('chk_out');
        $data['room_detail'] = $req->input('room_detail');
        $data['room_facility'] = $req->input('room_facility');
        $data['hanok_id'] = $hanok_id;
        $data['room_img1'] = 'img/roomImg/'.$fileName1;
        $data['room_img2'] = 'img/roomImg/'.$fileName2;
        $data['room_img3'] = 'img/roomImg/'.$fileName3;

        $room = Rooms::create($data);   // insert 
        if(!$room){
            $error = '잠시 후에 다시 시도해 주세요';
            return redirect()
                    ->route('admin.rooms.insert')
                    ->with('error',$error);
        }
        return redirect()
                ->route('admin.hanoks')
                ->with('success','숙소 등록 완료');
        
    }
    // 0720 add end KMH
    public function adminHanoksInsertPost(Request $req) {

        // $uploaded_file_name_tmp = $_FILES['hanok_img1']['tmp_name'];
        // $uploaded_file_name = $_FILES['hanok_img1']['name'];
        // $upload_folder = "/public/img/hanokImg";
        // move_uploaded_file( $uploaded_file_name_tmp, $_SERVER['DOCUMENT_ROOT'].'/img/hanokImg/'.$uploaded_file_name );
        // var_dump($req->hanok_img1[0], $req->hanok_img1[1]);
        // var_dump(count($req->file()['hanok_img1']) );
        $arr = [];
        // file 담는 배열
        $arr_chk = [];
        // 저장된 파일명 담는 배열
        $arr_upload_name = [];
        // 관리자로 로그인된 아이디 조회
        $loggedInadminId = Auth::guard('admins')->id();
        // // 관리자 로그인된 모든 값 확인 하고 싶을때
        // $loggedInUserall = Admins::all();

        // var_dump($loggedInUserall);
        // exit;
        // var_dump($req->file()['hanok_img1']) ;
        // exit;
        $arr = $req->file()['hanok_img1'];
        if( !(count($req->file()['hanok_img1']) >= 3 && count($req->file()['hanok_img1']) <= 5) ) {
            session()->flash('errMsg', '사진은 3개에서 5개 사이로 지정하세요.');
            return redirect()->back();
        }
        // 여러개 담은 파일들 arr_chk에 배열로 담아 줌
        foreach($arr as $value ) {
            $arr_chk[] = $value;
        }
        // 이미지 업로드 및 지정 경로 확인
        // for($i=0; $i <= count($req->file()['hanok_img1']) -1 ; $i++)
        for($i=0; $i < count($req->file()['hanok_img1']) ; $i++)
        {
            $arr_chk[$i]->store('/img/hanokImg');
            $arr_upload_name[] = $arr_chk[$i]->hashName();
        }
        // var_dump($arr_chk);
        // exit;
        $hanoks_insert = [
            'hanok_name' => $req->hanok_name
            , 'hanok_local' => $req->hanok_local
            , 'hanok_comment' => $req->hanok_comment
            , 'hanok_addr' => $req->hanok_addr
            , 'latitude' => $req->latitude
            , 'longitude' => $req->longitude
            , 'hanok_num' => $req->hanok_num
            , 'hanok_info' => $req->hanok_info
            , 'hanok_refund' => $req->hanok_refund
            , 'hanok_type' => $req->hanok_type
        ];
        // foreach($arr_chk as $value) {
        //     $hanoks_insert['']
        // }
        for($i=0; $i <= count($req->file()['hanok_img1']) -1 ; $i++)
        {
            $img_key = (string)'hanok_img'.$i+1;
            $img_value = (string)'img/hanokImg/'.$arr_upload_name[$i];
            $hanoks_insert[$img_key] = $img_value;
        }
        
        $hanoks_recreate = new Hanoks($hanoks_insert);
        $hanoks_recreate->save();

        return redirect()->route('admin.hanoks');





        // // 이미지 업로드
        // $req->hanok_img1->store('/img/hanokImg');

        // // 지정 경로 저장 후 파일 명 반환
        // $uploadOriginalName = $req->hanok_img1->hashName();
    }




    // 0721 add BYJ
    // 리뷰관리 정보
    public function adminReview() {

    $reviews = DB::table('users as u')
        ->join('reviews as rev', 'rev.user_id', '=', 'u.user_id')
        ->join('hanoks as han', 'han.id', '=', 'rev.hanok_id')
        // 0722 ysh review id, hanok id 추가
        ->select('*')
        // ->get();
        ->paginate(15);
    

        return view('adminReview')->with('review',$reviews);
    }

    // 리뷰관리 검색
    public function adminReviewSearch(Request $req) {

    $revkeyword = $req->input('revkeyword');
    // $revsearchType = $req->input('revsearchType');
    $reviews = DB::table('users as u')
        ->join('reviews as rev', 'rev.user_id', '=', 'u.user_id')
        ->join('hanoks as han', 'han.id', '=', 'rev.hanok_id')
        // 0722 ysh review id, hanok id 추가
        ->select('*')
        ->where('rev.rev_content', 'LIKE', '%' . $revkeyword . '%')
        ->orWhere('u.user_name', 'LIKE', '%' . $revkeyword . '%')
        // ->get();
        ->paginate(15);

        return view('adminReview')->with('review',$reviews);
    }
    // 0721 YSH add
    // 숙소 검색
    public function adminHanoksSearch(Request $request) {
        $users = DB::table('hanoks')->where('hanok_name','LIKE','%' . $request->hanoks . '%')->orWhere('hanok_addr','LIKE','%' . $request->hanoks . '%')
        // ->dd();
        ->paginate(16);
        return view('adminHanok')->with('hanoks',$users);
    }

    // 관리자 리뷰 가리기
    public function adminReviewUpdate(Request $req, $review_id) {
        $users = DB::table('reviews as r')
        ->select('r.*')
        ->where('r.rev_id', "=", $review_id)
        ->get();
        
        // var_dump($users[0]->rev_id);
        // exit;

        // // flg가 0은 출력용, 1은 가리기용
        // if( $users[0]->rev_flg === '0' ) {
        //     $users_update = DB::table('reviews as r')
        //                     ->where('r.rev_id', '=', $users[0]->rev_id)
        //                     ->update(['r.rev_flg' => '1']);
        //                     // ->get();
        // }
        // else {
        //     $users_update = DB::table('reviews as r')
        //                     ->where('r.rev_id', '=', $users[0]->rev_id)
        //                     ->update(['rev_flg' => '0']);
        // }
        // if( $users_update === 1) {

        // }

        // flg가 0은 출력용, 1은 가리기용
        try {
            if( $users[0]->rev_flg === '0' ) {
                $users_update = DB::transaction(function () use ($users) {
                                DB::table('reviews as r')
                                ->where('r.rev_id', '=', $users[0]->rev_id)
                                ->update(['r.rev_flg' => '1']);
                });
            }
            else {
                $users_update = DB::transaction(function () use ($users) {
                    DB::table('reviews as r')
                    ->where('r.rev_id', '=', $users[0]->rev_id)
                    ->update(['r.rev_flg' => '0']);
                });
            }
        
        
        } catch (\Exception $e) {
            return redirect()->back($e);
        }
        finally{
            return redirect()->route('admin.review');
        }
    }

    // 관리자 리뷰 삭제
    public function adminReviewDelete($review_id) {
        $users = DB::table('reviews as r')
            ->select('r.*')
            ->where('r.rev_id', "=", $review_id)
            ->get();

        Reviews::find($review_id)->delete();
        return redirect()->route('admin.review');
    }
}
