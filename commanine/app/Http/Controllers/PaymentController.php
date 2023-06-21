<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function payInfo(Request $req) {
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }
        $result = DB::table('rooms')
        ->select('room_name', 'room_price', 'hanok_name')
        ->join('hanoks', 'rooms.hanok_id', '=', 'hanoks.id')
        ->where('rooms.id', '=', $req->room_id)
        ->get();

        // $result 값을 배열에 저장
        $arr[] = ['room_price' => $result->room_price
            , 'room_name' => $result->room_name
            , 'hanok_name' => $result->hanok_name
        ];

        // request에 배열값 추가해서 결제 페이지 이동
        $data = $req->merge($arr);

        return view('payment')->with('data', $data);
    }
}
