<?php

namespace App\Http\Controllers;

use App\Models\Wishlists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiWishlistsController extends Controller
{
    public function getWishList($hanok_id) {
        // if(auth()->guest()) {
        //     return redirect()->route('users.login');
        // }
        // todo 로그인 확인해서 로그인 안 했으면 로그인 화면으로 보내기.
        $user_id = session('user_id');
        $like = DB::table('wishlists')
                    ->where('hanok_id', '=', $hanok_id)
                    ->where('user_id', '=', $user_id)
                    ->get();
        return response()->json([$like], 200);
    }
    // public function getWishList($hanok_id) {
    //     if(auth()->guest()) {
    //         return redirect()->route('users.login');
    //     }
    //     // todo 로그인 확인해서 로그인 안 했으면 로그인 화면으로 보내기.
    //     $user_id = session('user_id');
    //     $like = DB::table('wishlists')
    //                 ->where('hanok_id', '=', $hanok_id)
    //                 ->where('user_id', '=', $user_id)
    //                 ->get();
    //     $arrData = [
    //         'code'  => '0'
    //         ,'msg'  => ''
    //     ];
    //     if ($like === null) {
            
    //         $data = [
    //             'hanok_id'        => $hanok_id
    //             ,'user_id' =>$user_id
    //         ];
    
    //         // $validator = Validator::make($data, [
    //         //     'hanok_id'        => 'requierd|integer'
    //         //     ,'user_id' => 'requierd|integer'
    //         // ]);
    //         DB::table('wishlists')
    //             ->insert($data);
    //     } else {
    //         DB::table('wishlists')
    //             ->where('hanok_id', '=', $hanok_id)
    //             ->where('user_id', '=', $user_id)
    //             ->delete();
    //     }


    //     // if($validator->fails()) {
    //     //     $arrData['code']    = 'E01';
    //     //     $arrData['msg']     = '찜 조회에 실패했습니다.';
    //     //     $arrData['errmsg']  = $validator->errors()->all();
    //     // } else {
    //     //     $like = Wishlists::find($user_id, $hanok_id);
    //     //     if($like) {
    //     //         return response()->json($like, 200);
    //     //     } else {
    //     //         $arrData['code']    = 'E02';
    //     //         $arrData['msg']     = '찜을 하지 않았습니다.';
    //     //     }
    //     // };

    //     return $arrData;
    // }
}
