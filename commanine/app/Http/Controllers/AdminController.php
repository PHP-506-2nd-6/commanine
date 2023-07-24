<?php

namespace App\Http\Controllers;

use App\Mail\FindPassword;
use Illuminate\Http\Request;
use App\Models\Admins;
use App\Models\Amenities;
use App\Models\Rooms;
use App\Models\Hanoks;
use App\Models\Reservations;
use App\Models\Reviews;
use App\Models\Users;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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
        $admin = Auth::guard('admins')->check();
        if(!$admin){
            return redirect()->route('admin.login');
        }
        
        $users = DB::table('users')
                ->paginate(15);
        return view('adminUser')->with('users',$users);
    }
    public function adminUsersSearch(Request $request){
        $admin = Auth::guard('admins')->check();
        if(!$admin){
            return redirect()->route('admin.login');
        }
        $users = DB::table('users')->where('user_email','LIKE','%' . $request->users . '%')->orWhere('user_name','LIKE','%' . $request->users . '%')
                ->paginate(15);
        return view('adminUser')->with('users',$users);
    }
    // 0719 add end KMH

    // 0720 add KMH
    public function adminHanoks(){
        $admin = Auth::guard('admins')->check();
        if(!$admin){
            return redirect()->route('admin.login');
        }
        $hanoks = DB::table('hanoks')->select('id','hanok_name','hanok_addr','hanok_img1')->paginate(16);
        return view('adminHanok')->with('hanoks',$hanoks);
    }
    // 0720 add end KMH 
    public function adminHanoksInsert(){
        $admin = Auth::guard('admins')->check();
        if(!$admin){
            return redirect()->route('admin.login');
        }

        Log::debug("insert");
        return view('adminhanoksinsert');
    }

    // 0720 add KMH 
    public function adminHanoksDetail($hanok_id){
        
        $admin = Auth::guard('admins')->check();
        if(!$admin){
            return redirect()->route('admin.login');
        }

        // 쿼리
        // SELECT *
        // FROM hanoks han
        // where id = hanok_id
        // 숙소 정보 출력
        $hanoks = DB::table('hanoks')->where('id','=',$hanok_id)->get();
        $amenities = DB::table('amenities')->where('hanok_id','=',$hanok_id)->get();
        $category = [];
        foreach($amenities as $val)
        {
            $category[] =$val->amenity_category; 
        }

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
        return view('adminHanokDetail')->with('hanoks',$hanoks[0])->with('rooms',$rooms)->with('amenities',$category);
    }
    // 0720 add end KMH


    // 0720 add BYJ
    // 예약관리 정보
    public function adminReservation() {
        //test
        // $reserve = DB::table('reservations')
        // ->orderBy('id','desc')
        // ->paginate(15);
        $admin = Auth::guard('admins')->check();
        if(!$admin){
            return redirect()->route('admin.login');
        }

        $reserve = DB::table('rooms as room')
        ->join('hanoks as han', 'han.id', '=', 'room.hanok_id')
        ->join('reservations as re', 're.room_id', '=', 'room.id')
        ->SELECT('re.id as reserve_id','re.reserve_name','re.reserve_num','han.id','han.hanok_name', 'room.room_name', 'room.room_price', 're.chk_in', 're.chk_out', 're.reserve_adult', 're.user_id', 're.reserve_flg','re.created_at')
        // ->where('re.id', $reserve_id)
        ->orderBy('re.id', 'desc')
        ->paginate(15);
        

        return view('adminReserve')->with('reservations',$reserve);
    }
    // 0721 add BYJ
    // 예약관리 검색
    public function adminReservationSearch(Request $req){
        $admin = Auth::guard('admins')->check();
        if(!$admin){
            return redirect()->route('admin.login');
        }
        // test
        // $reserve = DB::table('reservations')->where('id','LIKE','%' . $req->id . '%')->orWhere('reserve_name','LIKE','%' . $req->reserve_name . '%')
        // ->paginate(15);
        // $reserve_id = 25;

        $keyword = $req->input('keyword');
        $searchType = $req->input('searchType');
        $reserveStatus = $req->input('reserveStatus'); // 예약상태폼 변수
        $chkIn = $req->input('chkIn'); // 예약 시작일
        $chkOut = $req->input('chkOut'); // 예약 종료일

        $reserve = DB::table('rooms as room')
            ->join('hanoks as han', 'han.id', '=', 'room.hanok_id')
            ->join('reservations as re', 're.room_id', '=', 'room.id')
            ->select('re.id as reserve_id', 're.reserve_name', 're.reserve_num', 'han.id', 'han.hanok_name', 'room.room_name', 'room.room_price', 're.chk_in', 're.chk_out', 're.reserve_adult', 're.user_id', 're.reserve_flg', 're.created_at');
            // ->Where('re.' . $searchType, 'LIKE', '%' . $keyword . '%');
            // ->orderBy('re.id', 'desc');
            // ->get();
            // ->paginate(15);

    // 검색 조건 추가
    if (!empty($keyword) && !empty($searchType)) {
        $reserve->where('re.' . $searchType, 'LIKE', '%' . $keyword . '%');
    }

    // 예약 상태로 필터링
    if ($reserveStatus === '1') {
        $reserve->where('re.reserve_flg', 1); // 예약대기인 예약만 보여줌
    } elseif ($reserveStatus === '0') {
        $reserve->where('re.reserve_flg', 0); // 예약완료인 예약만 보여줌
    }

     // 예약 기간으로 필터링
     if (!empty($chkIn) && !empty($chkOut)) {
        $reserve->whereDate('re.chk_in', '>=', $chkIn)
            ->whereDate('re.chk_out', '<=', $chkOut);
    }

    $reserve = $reserve->orderBy('re.id', 'desc')
        ->paginate(15);
        // dd($reserve->toSql());/
        return view('adminReserve')->with('reservations',$reserve);
    }

    // 0720 add KMH
    public function adminRoomsInsert($hanok_id){
        $admin = Auth::guard('admins')->check();
        if(!$admin){
            return redirect()->route('admin.login');
        }

        $hanoks = DB::table('hanoks')->select('hanok_name','hanok_addr','id')->where('id','=',$hanok_id)->get();
        return view('adminRoomsInsert')->with('hanoks',$hanoks[0]);
    }
    public function adminRoomsInsertPost($hanok_id,Request $req){
        $admin = Auth::guard('admins')->check();
        if(!$admin){
            return redirect()->route('admin.login');
        }

        // 가격이 4자리 이상일 경우 => , 제거
        $countPrice = strlen($req->room_price);
        if($countPrice > 3){
            $price = (int)str_replace(',', '', $req->room_price);
        }else{
            // 아닌 경우 그대로
            $price = (int)$req->room_price;
        }
        $error = "모든 사항은 필수 사항 입니다.";
        // 유효성 검사
        $validator = Validator::make(
            $req->only('room_name','room_content','room_price','room_min','room_max','chk_in','chk_out','room_detail','room_facility')
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
            ]);
        // 실패했을 경우 
        if($validator->fails()){
            return redirect()->back()->with('error',$error);
        }
        //--  이미지 3개 검사  
        $arr = [];
        // file 담는 배열
        $arr_chk = [];
        // 저장된 파일명 담는 배열
        $arr_upload_name = [];
        // 관리자로 로그인된 아이디 조회
        $loggedInadminId = Auth::guard('admins')->id();
        $arr = $req->file()['room_img'];
        // 이미지파일이 3개가 아닌 경우 
        if(count($req->file()['room_img']) !== 3){
            // 세션에 에러메세지를 담아주고 back
            session()->flash('errMsg','사진은 3개만 저장하세요.');
            return redirect()->back();
        }
        // 여러개 담은 파일들 arr_chk에 배열로 담아 줌
        foreach($arr as $value ) {
            $arr_chk[] = $value;
        }
        // 이미지 업로드 및 지정 경로 확인
        for($i=0; $i < count($req->file()['room_img']) ; $i++)
        {
            $arr_chk[$i]->store('/img/roomImg');
            $arr_upload_name[] = $arr_chk[$i]->hashName();
        }

        // Insert할 값들을 배열에 담아준다.
        $rooms_insert = [
            'room_name' => $req->room_name
            , 'room_content' => $req->room_content
            , 'room_comment'    => $req->room_comment
            , 'room_price' => $price
            , 'room_min' => $req->room_min
            , 'room_max' => $req->room_max
            , 'chk_in' => $req->chk_in
            , 'chk_out' => $req->chk_out
            , 'room_detail' => $req->room_detail
            , 'room_facility' => $req->room_facility
            , 'hanok_id' => $hanok_id
        ];

        for($i=0; $i < count($req->file()['room_img']) ; $i++)
        {
            $img_key = (string)'room_img'.$i+1;
            $img_value = (string)'img/roomImg/'.$arr_upload_name[$i];
            $rooms_insert[$img_key] = $img_value;
        }
        
        $room = Rooms::create($rooms_insert);   // insert 
        if(!$room){
            $error = '잠시 후에 다시 시도해 주세요';
            return redirect()
                    ->back()
                    ->with('error',$error);
        }
        return redirect()
                ->route('admin.hanoks')
                ->with('success','객실 등록 완료');
    }
    // 0720 add end KMH
    // 0722 add KMH
    public function adminHanokUpdate(Request $request) {
        $admin = Auth::guard('admins')->check();
        if(!$admin){
            return redirect()->route('admin.login');
        }

        $error = "모든 사항은 필수 사항 입니다.";
        // 체크박스를 여러개 체크하면 $request->amenity에 배열로 담아져서 옴
        // 비어있을 경우 빈 배열 $requestAmenity 을 만들고 
        if(empty($request->amenity)){
            
            $requestAmenity = [];
        }else{
        // 아닌 경우 $request->amenty 값들을 $requestAmenity에 담아줌
            foreach($request->amenity as $val){
                $requestAmenity[] = $val;
            }
        }
        Log::debug('request amenity 확인',[$requestAmenity]);
        Log::debug('checkbox',[$request->only('amenity')]);
        
        $arrKey=[];
        //ㅡㅡㅡㅡㅡㅡ유효성 체크 하는 모든 항목 리스트 
        $chkList=[
            'hanok_id'          => 'required'
            ,'hanok_name'       => 'required'
            , 'hanok_comment'   => 'required'
            , 'hanok_addr'      => 'required'
            , 'hanok_num'       => 'required'
            , 'hanok_info'      => 'required'
            , 'hanok_refund'    => 'required'
            , 'hanok_type'      => 'required'
            , 'hanok_img1'      => 'required'
            , 'hanok_img2'      => 'required'
            , 'hanok_img3'      => 'required'
            , 'amenity'         => 'required'
                ];
        Log::debug('어메니티 값' ,[$requestAmenity]);
        // 기존 hanoks 데이터 가져오기 
        $hanoks = Hanoks::find($request->hanok_id); 
        // 해당 숙소의 어메니티 가져오기
        $amenities = DB::table('amenities')->where('hanok_id','=',$request->hanok_id)->get();   // 
        $category = [];
        // $category 배열에 $amenity_category 값들 담아주기
        foreach($amenities as $val)
        {
            $category[] =(string)$val->amenity_category; 
        }
        // 요청된 aemnity랑 데이터베이스에 있는 카테고리들 비교 
        // compare_arr1 => 체크박스중 추가한 값들을 배열로 나타냄
        $compare_arr1 = array_diff($requestAmenity, $category); 
        // compare_arr2 => 체크박스중 제가한 값들을 배열로 나타냄
        $compare_arr2 = array_diff($category,$requestAmenity); 
         Log::debug('카테고리1 비교',$compare_arr1);   
         Log::debug('카테고리2 비교',$compare_arr2);   
        // $compare_arr1 과 $compare_arr이 하나라도 존재하면(값 변경) $arrKey[]에 담아준다.
        if($compare_arr1 ||$compare_arr2){
            $arrKey[] = 'amenity';
        Log::debug('체크박스 값 변경시 arrKey에 추가',$arrKey);
        }

        // 수정할 항목을 배열에 담는 처리
        // 변경된 항목만 담음
        if($request->hanok_name !== $hanoks->hanok_name){
            $arrKey[]='hanok_name';
        }
        if($request->hanok_comment !== $hanoks->hanok_comment){
            $arrKey[]='hanok_comment';
        }

        if($request->hanok_addr !== $hanoks->hanok_addr){
            $arrKey[]='hanok_addr';
        }
        if($request->hanok_num !== $hanoks->hanok_num){
            $arrKey[]='hanok_num';
        }

        if($request->hanok_info !== $hanoks->emahanok_infoil){
            $arrKey[]='hanok_info';
        }
        if($request->hanok_refund !== $hanoks->hanok_refund){
            $arrKey[]='hanok_refund';
        }

        if($request->hanok_type !== $hanoks->hanok_type){
            $arrKey[]='hanok_type';
        }
        if(isset($request->hanok_img1)){
            $arrKey[]='hanok_img1';
        }
        if(isset($request->hanok_img2)){
            $arrKey[]='hanok_img2';

        }
        if(isset($request->hanok_img3)){
            $arrKey[]='hanok_img3';
        }
        Log::debug('변경된 값 확인');
        $hanok_id = $request->hanok_id;
        // 변경된 항목 담기 END

        // try catch finally
        try {
            Log::debug('try');
            // arrKey 값을 키로 가진 $chkList의 값들을 $arrChek에 담음
            foreach($arrKey as $val){
                $arrCheck[$val] = $chkList[$val]; 
            }
            // 유효성 검사
            $validate =  $request->validate($arrCheck);
            Log::debug('유효성검사');
            foreach($arrKey as $val){
                // 트랜잭션 시작
                DB::beginTransaction();
                Log::debug('Start amenity transaction');
                // $arrKey에 amenity가 있는 경우
                if($val === 'amenity'){
                    // $compare_arr1이 있을 경우에는 insert를 해주어야 하고
                    // $compare_arr2가 있는 경우에는 delete를 해주어야 함
                    // 추가했을 때 insert 
                    if(!empty($compare_arr1)){
                        Log::debug('-------------amenity 추가--------------');
                        // $compare_arr1에 들어있는 값의 개수 만큼 insert 
                        foreach($compare_arr1 as $val){
                            Log::debug('추가할 값 확인',[$val]);
                            $insert_amenity = DB::table('amenities')
                                                ->insert([
                                                ['hanok_id' => $request->hanok_id
                                                , 'amenity_category' => $val],
                                                ]);
                            // insert가 실패했을 경우
                            if(!$insert_amenity){
                                throw new Exception('amenity insert Error');
                            }
                        }
                        Log::debug('insert success');
                        continue;
                    }
                    // 체크박스를 해제 했을 때 delete
                    if(!empty($compare_arr2)){
                        // $compare_arr2에 들어있는 값의 개수 만큼 delete
                        foreach($compare_arr2 as $val){
                            $deleted_amenity = DB::table('amenities')
                                ->where('hanok_id','=',$request->hanok_id)
                                ->where('amenity_category','=',$val)
                                ->delete();
                            // delete 실패했을 경우
                            if(!$deleted_amenity){
                                throw new Exception('amenity delete Error');
                            }
                        }
                        Log::debug('delete success');
                        continue;
                    }
                }
                // 수정한 hanok_img1가 있는 경우
                if($val === 'hanok_img1'){
                    // 이전에 있던 이미지 삭제하고
                    Storage::disk('public')->delete($hanoks->hanok_img1);
                    // 수정한 이미지 저장
                    $request->hanok_img1->store('/img/hanokImg');
                    // 파일명
                    $fileName1 = $request->hanok_img1->hashName();
                    // 파일경로
                    $hanoks->$val = 'img/hanokImg/'.$fileName1;
                    continue;
                }
                // 수정한 hanok_img2가 있는 경우
                if($val === 'hanok_img2'){
                    // 이전에 있던 이미지 삭제하고
                    Storage::disk('public')->delete($hanoks->hanok_img2);
                    // 수정한 이미지 저장
                    $request->hanok_img2->store('/img/hanokImg');
                    // 파일명
                    $fileName2 = $request->hanok_img2->hashName();
                    // 파일경로
                    $hanoks->$val = 'img/hanokImg/'.$fileName2;
                    continue;
                }
                // 수정한 hanok_img3가 있는 경우
                if($val === 'hanok_img3'){
                    // 이전에 있던 이미지 삭제하고
                    Storage::disk('public')->delete($hanoks->hanok_img3);
                    // 수정한 이미지 저장
                    $request->hanok_img3->store('/img/hanokImg');
                    // 파일명
                    $fileName3 = $request->hanok_img3->hashName();
                    $hanoks->$val = 'img/hanokImg/'.$fileName3;
                    // 파일경로
                    continue;
                }
                // 수정한 값들로 변경
                $hanoks->$val = $request->$val;
            }
            Log::debug('hanok update',[$hanoks]);
            // update
            $update_hanok = $hanoks->save(); // update
            Log::debug('update hanok 확인',[$update_hanok]);
            // update error 발생 시
            if(!$update_hanok){
                Log::debug('update Error');
                throw new Exception('update hanok Error');
            }
            Log::debug('End transaction');
            DB::commit();
        }    
        catch (Exception $e){
            Log::debug('error',[$e->getMessage()]);
            DB::rollBack();
            return redirect()->back()->with('error',$error);
        }
        finally{
            return redirect()->route('admin.hanoks.detail',[ 'hanok_id' => $request->hanok_id ]);
        }

    }

    public function adminRoomUpdate(Request $request) {
        $admin = Auth::guard('admins')->check();
        if(!$admin){
            return redirect()->route('admin.login');
        }

        // 가격이 3자리 초과일 경우 , 제거
        $countPrice = strlen($request->room_price);
        if($countPrice > 3){
            $price = (int)str_replace(',', '', $request->room_price);
        }else{
        // 아닌 경우 그대로
            $price = $request->room_price;
        }
        $arrKey=[];
        //ㅡㅡㅡㅡㅡㅡ유효성 체크 하는 모든 항목 리스트 
        $chkList=[
            'room_id'           => 'required'
            ,'room_name'        => 'required'
            , 'room_content'    => 'required'
            , 'room_price'      => 'required'
            , 'room_min'        => 'required'
            , 'room_max'        => 'required'
            , 'chk_in'          => 'required'
            , 'chk_out'         => 'required'
            , 'room_detail'     => 'required'
            , 'room_facility'   => 'required'
            , 'room_img1'       => 'required'
            , 'room_img2'       => 'required'
            , 'room_img3'       => 'required'
        ];
        // 기존 데이터 가져옴 
        $rooms = Rooms::find($request->room_id); 
        

        // 수정할 항목을 배열에 담는 처리
        // 변경된 항목만 담음
        if($request->room_name !== $rooms->room_name){
            $arrKey[]='room_name';
        }

        if($request->room_content !== $rooms->room_content){
            $arrKey[]='room_content';
        }

        if($price !== $rooms->room_price){
            $arrKey[]='room_price';
        }

        if((int)$request->room_min !== $rooms->room_min){
            $arrKey[]='room_min';
        }
        if((int)$request->room_max !== $rooms->room_max){
            $arrKey[]='room_max';
        }
        if($request->chk_in !== $rooms->chk_in){
            $arrKey[]='chk_in';
        }
        if($request->chk_out !== $rooms->chk_out){
            $arrKey[]='chk_out';
        }
        if($request->room_detail !== $rooms->room_detail){
            $arrKey[]='room_detail';
        }
        if($request->room_facility !== $rooms->room_facility){
            $arrKey[]='room_facility';
        }
        if(isset($request->room_img1)){
            $arrKey[]='room_img1';
            // 기존에 있던 파일 삭제
        }
        if(isset($request->room_img2)){
            $arrKey[]='room_img2';

        }
        if(isset($request->room_img3)){
            $arrKey[]='room_img3';
        }
        // 수정할 항목을 배열에 담는 처리 END
        // try catch finally
    try {
        // arrKey 값을 키로 가진 $chkList의 값들을 $arrChek에 담음
        foreach($arrKey as $val){
            $arrCheck[$val] = $chkList[$val]; 
        }
        // 유효성 검사
        $validate =  $request->validate($arrCheck);

        foreach($arrKey as $val){
            // $arrKey의 값에 'room_price가 있는 경우
            if($val === 'room_price'){
                // price 값을 넣어줌
                $rooms->$val = $price;
                continue;
            }
            // 수정한 room_img1 있는 경우
            if($val === 'room_img1'){
                // 이전에 있던 이미지 삭제하고
                Storage::disk('public')->delete($rooms->room_img1);
                // 수정한 이미지 저장
                $request->room_img1->store('/img/roomImg');
                // 파일명
                $fileName1 = $request->room_img1->hashName();
                // 파일경로
                $rooms->$val = 'img/roomImg/'.$fileName1;
                continue;
            }
            // 수정한 room_img2 있는 경우
            if($val === 'room_img2'){
                // 이전에 있던 이미지 삭제하고
                Storage::disk('public')->delete($rooms->room_img2);
                // 수정한 이미지 저장
                $request->room_img2->store('/img/roomImg');
                // 파일명
                $fileName2 = $request->room_img2->hashName();
                // 파일경로
                $rooms->$val = 'img/roomImg/'.$fileName2;
                continue;
            }
            // 수정한 room_img3 있는 경우
            if($val === 'room_img3'){
                // 이전에 있던 이미지 삭제하고
                Storage::disk('public')->delete($rooms->room_img3);
                // 수정한 이미지 저장
                $request->room_img3->store('/img/roomImg');
                // 파일명
                $fileName3 = $request->room_img3->hashName();
                // 파일경로
                $rooms->$val = 'img/roomImg/'.$fileName3;
                continue;
            }
            // 나머지 변경된 값들 변경
            $rooms->$val = $request->$val;
        }    
        // update
        $roomUpdate = $rooms->save(); 
        // update 실패시
        if(!$roomUpdate){
            throw new Exception('update room Error');
        }
    }
    catch (Exception $e){
        Log::debug('Rooms update Error',[$e->getMessage()]);
        DB::rollBack();
        return redirect()->back()->with('roomError','모든 값은 필수 사항 입니다.');
    }
    finally{
        return redirect()->route('admin.hanoks.detail',[ 'hanok_id' => $request->hanok_id ]);
    }
    }
    // 0722 add end KMH
    public function adminHanoksInsertPost(Request $req) {
        $admin = Auth::guard('admins')->check();
        if(!$admin){
            return redirect()->route('admin.login');
        }
        
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
        $admin = Auth::guard('admins')->check();
        if(!$admin){
            return redirect()->route('admin.login');
        }

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
        $admin = Auth::guard('admins')->check();
        if(!$admin){
            return redirect()->route('admin.login');
        }

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
        $admin = Auth::guard('admins')->check();
        if(!$admin){
            return redirect()->route('admin.login');
        }

        $users = DB::table('hanoks')->where('hanok_name','LIKE','%' . $request->hanoks . '%')->orWhere('hanok_addr','LIKE','%' . $request->hanoks . '%')
        // ->dd();
        ->paginate(16);
        return view('adminHanok')->with('hanoks',$users);
    }

    // 관리자 리뷰 가리기
    public function adminReviewUpdate(Request $req, $review_id) {
        $admin = Auth::guard('admins')->check();
        if(!$admin){
            return redirect()->route('admin.login');
        }
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
        $admin = Auth::guard('admins')->check();
        if(!$admin){
            return redirect()->route('admin.login');
        }
        $users = DB::table('reviews as r')
            ->select('r.*')
            ->where('r.rev_id', "=", $review_id)
            ->get();

        Reviews::find($review_id)->delete();
        return redirect()->route('admin.review');
    }

    
    // 0722 add KMJ
    // 관리자 유저 탈퇴 기능
    public function adminUserUnregist($user_id) {
        $admin = Auth::guard('admins')->check();
        if(!$admin){
            return redirect()->route('admin.login');
        }
        // 유저 id로 삭제
        $user = Users::find($user_id);
        $user->delete();
        return redirect()->back();
    }

    // 관리자 유저 비밀번호 리셋 기능(임시 비밀번호 메일로 발송)
    public function adminUserPwReset($user_id){
        $admin = Auth::guard('admins')->check();
        if(!$admin){
            return redirect()->route('admin.login');
        }
        $user = Users::find($user_id);
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
        Mail::to($user->user_email)->send(new FindPassword($pw));
        return redirect()->back();
    }
    
    // 0724 byj
    // 예약 정보 수정
    public function adminReservationEdit($reserve_id) {
        $admin = Auth::guard('admins')->check();
        if(!$admin){
            return redirect()->route('admin.login');
        }
        $reserve = DB::table('rooms as room')
        ->join('hanoks as han', 'han.id', '=', 'room.hanok_id')
        ->join('reservations as re', 're.room_id', '=', 'room.id')
        ->SELECT('re.id as reserve_id','re.reserve_name','re.reserve_num','han.id','han.hanok_name', 'room.room_name', 'room.room_price', 're.chk_in', 're.chk_out', 're.reserve_adult', 're.reserve_child' , 're.user_id', 're.reserve_flg','re.created_at')
        ->where('re.id','=',$reserve_id)
        ->orderBy('re.id', 'desc')
        ->paginate(15);

        return view('adminReserveUp')->with('reservations',$reserve[0]);
    }
    public function adminReservationUp(Request $req, $reserve_id) {
        $admin = Auth::guard('admins')->check();
        if(!$admin){
            return redirect()->route('admin.login');
        }
        // $arrKey=[];
        // //ㅡㅡㅡㅡㅡㅡ유효성 체크 하는 모든 항목 리스트 
        // $chkList=[
        //     'reserve_name'          => 'reserve_name'
        // ];

    // 예약 정보를 db에서 가져옴
    $reserve = Reservations::find($reserve_id);

    // 폼에서 제출된 데이터를 기반으로 예약 정보 필드를 업데이트
    $reserve->reserve_name = $req->input('reserve_name');
    $reserve->reserve_num = $req->input('reserve_num');
    $reserve->reserve_flg = $req->input('reserve_flg');

    // 업데이트된 예약 정보를 저장
    $reserve->save();

    // 수정이 완료되면 예약 목록 페이지 또는 업데이트된 예약 정보를 보여주는 페이지로 리다이렉션
    return redirect()->route('admin.reservation');

    }
}
