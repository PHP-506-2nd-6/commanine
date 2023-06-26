<?php

namespace App\Http\Controllers;

use App\Models\Reservations;
use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\VarDumper\VarDumper;

class PaymentController extends Controller
{
    public function payInfo(Request $req) {
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }
        $result = DB::table('rooms')
        ->select('room_name', 'room_price', 'hanok_name', 'hanoks.id')
        ->join('hanoks', 'rooms.hanok_id', '=', 'hanoks.id')
        ->where('rooms.id', '=', $req->room_id)
        ->get();
        
        // $result 값을 배열에 저장
        $arr = ['room_price' => $result[0]->room_price
        , 'room_name' => $result[0]->room_name
        , 'hanok_name' => $result[0]->hanok_name
        , 'hanok_id' => $result[0]->id
        ];
        // request에 배열값 추가해서 결제 페이지 이동
        $data = $req->merge($arr);
        
        return view('payment')->with('data', $data);
    }
    public function payInfopost(Request $req) {
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }
        $user_id = Auth::User()->user_id;
        $req->validate([
            'reserve_name' => 'required|max:30|regex:/^[가-힣]{2,30}$/'
            , 'reserve_num' => 'required|regex:/^[0-9]{3}[0-9]{4}[0-9]{4}$/'
        ]);
        $result = DB::table('rooms')->select('room_name', 'room_price', 'chk_in', 'chk_out', 'room_img1', 'hanok_name')
        ->join('hanoks', 'rooms.hanok_id', '=', 'hanoks.id')
        ->where('rooms.id', '=', $req->room_id)
        ->get();
        $arr = ['room_name' => $result[0]->room_name
        , 'room_price' => $result[0]->room_price
        // 체크인 체크아웃 시간
        , 'chk_in' => $result[0]->chk_in
        , 'chk_out' => $result[0]->chk_out
        , 'room_img1' => $result[0]->room_img1
        , 'hanok_name' => $result[0]->hanok_name
    ];
    $req->merge($arr);
    // 예약 정보만 저장
    $reserve = new Reservations([
        'reserve_adult' => $req->reserve_adult
        , 'reserve_child' => $req->reserve_child
        // 값 제대로 넘겨오면 주석 해제하기(체크인 체크아웃 날짜)
        // , 'chk_in' => $req->chk_in_date
        // , 'chk_out' => $req->chk_out_date
        , 'chk_in' => date("Ymd")
        , 'chk_out' => date("Ymd")
        // , 'reserve_flg' => 0
        , 'reserve_name' => $req->reserve_name
        , 'reserve_num' => $req->reserve_num
        , 'user_id' => $user_id
        , 'room_id' => $req->room_id
    ]);
    $reserve->save();
    $payment = new Payments([
        'reserve_id' => $reserve->id
        , 'pay_price' => $req->room_price
        , 'pay_type' => $req->pay_type
        , 'pay_flg' => '1'
    ]);
    $payment->save();
    // 결제가 완료 됐을때 예약 플래그 1(예약 완료) 로 변경후 결제 완료 페이지
    if($payment) {
        $reservation = Reservations::find($reserve->id);
        $reservation->reserve_flg = '1';
        $reservation->save();
        $result = DB::table('reservations')->select('reservations.updated_at', 'reservations.reserve_adult', 'reservations.id', 'reservations.chk_in as chk_in_date', 'reservations.chk_out as chk_out_date', 'rooms.room_name'
                    , 'rooms.room_img1', 'rooms.chk_in', 'rooms.chk_out', 'hanoks.hanok_addr', 'hanoks.hanok_name', 'hanoks.hanok_num', 'payments.pay_price', 'payments.pay_type')
                    ->join('rooms', 'rooms.id', '=', 'reservations.room_id')
                    ->join('hanoks', 'rooms.hanok_id', '=', 'hanoks.id')
                    ->join('payments', 'payments.reserve_id', '=', 'reservations.id')
                    ->where('reservations.id', '=', $reservation->id)
                    ->get();
        echo "<script>alert('결제가 완료 되었습니다.');</script>";
        return view('payCompInfo')->with('data', $result);
    }
    // 결제가 취소되었을 때 결제 페이지 재실행
    echo "<script>alert('결제가 취소 되었습니다 다시 결제해 주세요');</script>";
    return Redirect()->route('users.payment');
    }
}