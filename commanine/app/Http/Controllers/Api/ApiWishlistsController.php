<?php

namespace App\Http\Controllers;

use App\Models\Wishlists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiWishlistsController extends Controller
{
    public function getWishList($hanok_id) {
        $user_id = session('user_id');
        $arrData = [
            'code'  => '0'
            ,'msg'  => ''
        ];

        $data = [
            'hanok_id'        => $hanok_id
            ,'user_id' =>$user_id
        ];

        $validator = Validator::make($data, [
            'hanok_id'        => 'requierd|integer'
            ,'user_id' => 'requierd|integer'
        ]);

        if($validator->fails()) {
            $arrData['code']    = 'E01';
            $arrData['msg']     = '찜 조회에 실패했습니다.';
            $arrData['errmsg']  = $validator->errors()->all();
        } else {
            $like = Wishlists::find($user_id, $hanok_id);
            if($like) {
                return response()->json($like, 200);
            } else {
                $arrData['code']    = 'E02';
                $arrData['msg']     = '찜을 하지 않았습니다.';
            }
        };

        return $arrData;
    }
}
