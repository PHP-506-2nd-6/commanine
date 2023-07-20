<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admins;
use App\Models\Rooms;
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
            Auth::login($admin);
            session($admin->only('id','admin_id')); 
            // session()->forget('admin');
            return redirect()->intended(route('admin.regist'));
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
        $hanoks = DB::table('hanoks')->select('id','hanok_name','hanok_addr','hanok_img1')->paginate(15);
        return view('adminHanok')->with('hanoks',$hanoks);
    }
    // 0720 add end KMH 
    public function adminHanoksInsert(){
        Log::debug("insert");
    return view('adminHanoksInsert');
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


    public function adminReservation() {
        // $reserve = DB::table('reservations')->select('id','reserve_adult')
        $reserve = DB::table('rooms as room')
        ->join('hanoks as han', 'han.id', '=', 'room.hanok_id')
        ->join('reservations as re', 're.room_id', '=', 'room.id')
        ->select('han.id','han.hanok_name', 'han.hanok_img1', 'room.room_name', 'room.room_price', 're.chk_in', 're.chk_out', 're.reserve_adult', 're.user_id', 're.reserve_flg')
        ->where('re.user_id', '4')
        ->orderBy('re.id', 'desc')
        ->paginate(5);
        // ->dd();
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
}
