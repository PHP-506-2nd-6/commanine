<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Models
 * 파일명     : HanoksController.php
 * 이력       : 0614 new
 *              0619 add
 * *********************************** */
namespace App\Http\Controllers;

use App\Models\Hanoks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// 0614 KMJ new
class HanoksController extends Controller
{
    // public function hanoksDetail($id) {
    //     $hanoks = Hanoks::find($id);
    //     // $hanoks = DB::table('hanoks as h')
    //     //                 ->join('wishlists as w', 'h.id', '=', 'w.hanok_id')
    //     //                 ->select('h.*',DB::raw("count(w.user_id) as likes"))
    //     //                 ->where('h.id', '=', $id)
    //     //                 ->groupBy('h.id','h.hanok_name')
    //     //                 ->get();
    //     // 0615 해당 숙소의 객실 정보 가져오기 KMJ add
    //     // todo 예약이 이미 된 날짜엔 객실 정보가 뜨지 않거나, 예약하기 버튼이 예약마감으로 바뀌든 비활성화되든 해야함
    //     $rooms = DB::table('hanoks as h')
    //                     ->join('rooms as r', 'h.id', '=', 'r.hanok_id')
    //                     ->select('r.*')
    //                     ->where('h.id', '=', $id)
    //                     ->get();
    //     // 0615 해당 숙소의 찜 갯수 가져오기 KMJ add
    //     $likes = DB::table('hanoks as h')
    //                     ->join('wishlists as w', 'h.id', '=', 'w.hanok_id')
    //                     ->select(DB::raw("count(w.user_id) as 'likes'"))
    //                     ->where('h.id', '=', $id)
    //                     ->get();
    //     // 0619 해당 숙소의 리뷰 가져오기 KMJ add
    //     $reviews = DB::table('hanoks as h')
    //                     ->join('reviews as r', 'h.id', '=', 'r.hanok_id')
    //                     ->select('r.*')
    //                     ->where('h.id', "=", $id)
    //                     // ->groupBy('r.rev_id')
    //                     ->get();
    //     // TODO 리턴값 확인용  // return var_dump($hanoks);
    //     // return view('detail')->with('hanok', $hanoks); // 0615 KMJ del
    //     return view('detail')->with('hanok', $hanoks)->with('rooms', $rooms)->with('likes', $likes[0])->with('reviews', $reviews); // 0615 KMJ new
    // }
    public function hanoksDetail($id, Request $req) {
        $hanoks = Hanoks::find($id);
        // $hanoks = DB::table('hanoks as h')
        //                 ->join('wishlists as w', 'h.id', '=', 'w.hanok_id')
        //                 ->select('h.*',DB::raw("count(w.user_id) as likes"))
        //                 ->where('h.id', '=', $id)
        //                 ->groupBy('h.id','h.hanok_name')
        //                 ->get();
        // 0615 해당 숙소의 객실 정보 가져오기 KMJ add
        // todo 예약이 이미 된 날짜엔 객실 정보가 뜨지 않거나, 예약하기 버튼이 예약마감으로 바뀌든 비활성화되든 해야함
        $rooms = DB::table('hanoks as h')
                        ->join('rooms as r', 'h.id', '=', 'r.hanok_id')
                        ->select('r.*')
                        ->where('h.id', '=', $id)
                        ->get(); // 0620 KMJ del
        $val_count = $req->input('reserve_adult') + $req->input('reserve_child');
        $val_chkIn = $req->input('chk_in');
        // $val_chkIn = '2023-06-14';
        $val_chkOut = $req->input('chk_out');
        // $val_chkOut = '2023-06-15';
        $query =
        " SELECT * "
        ." FROM rooms r "
        ." WHERE r.hanok_id = ".$id
		."  AND r.room_max >= ".$val_count
		."  AND NOT EXISTS( "
						."  SELECT 1 "
						."  FROM reservations res "
						."  WHERE res.room_id = r.id "
						// ."  AND res.chk_in <= '2023-06-22' "
						// ."  AND res.chk_out >= '2023-06-23' "
						."  AND res.chk_in <= ".$val_chkIn
						."  AND res.chk_out >= ".$val_chkOut
                        ." ) "
                        ;
                        
                        // return var_dump($val_chkIn, $val_count, $req);
        // $rooms = DB::select($query);
        // 0615 해당 숙소의 찜 갯수 가져오기 KMJ add
        $likes = DB::table('hanoks as h')
                        ->join('wishlists as w', 'h.id', '=', 'w.hanok_id')
                        ->select(DB::raw("count(w.user_id) as 'likes'"))
                        ->where('h.id', '=', $id)
                        ->get();
        // 0619 해당 숙소의 리뷰 가져오기 KMJ add
        $reviews = DB::table('hanoks as h')
                        ->join('reviews as r', 'h.id', '=', 'r.hanok_id')
                        ->select('r.*')
                        ->where('h.id', "=", $id)
                        // ->groupBy('r.rev_id')
                        ->get();
        // TODO 리턴값 확인용 
        // return var_dump($rooms);
        // return view('detail')->with('hanok', $hanoks); // 0615 KMJ del
        return view('detail')->with('hanok', $hanoks)->with('rooms', $rooms)->with('likes', $likes[0])->with('reviews', $reviews); // 0615 KMJ new
    }


    // 0619 BYJ new
    public function hanoksMain() {
        // $hanoks = DB::table('hanoks')
        //             -> select('*')
        //             -> orderBy('id','desc')
        //             -> limit('6')
        //             -> get();

        $hanoks = DB::table('hanoks as han')
        -> select('han.hanok_name', 'han.hanok_img1', 'han.hanok_local', DB::raw('MIN(ro.room_price) AS room_price'))
        -> join('rooms as ro', 'han.id', '=', 'ro.hanok_id')
        //-> join('reviews AS re', 'han.id', '=', 're.hanok_id')
        -> groupBy('han.hanok_name', 'han.hanok_name', 'han.hanok_img1', 'han.hanok_local')
        // -> groupBy('han.hanok_img1')
        // -> groupBy('han.hanok_local')
        // -> groupBy('ro.room_price')
        -> orderBy('han.id', 'DESC')
        -> limit('6')
        -> get();


        
    // $hanoks = DB::table('hanoks AS han')
    // ->select('han.hanok_name', 'han.hanok_img1', 'han.hanok_local', 'ro.room_price')
    // ->join('rooms AS ro', 'han.id', '=', 'ro.hanok_id')
    // ->groupBy('han.id')
    // ->orderBy('han.id', 'desc')
    // ->limit(6);

    // $results = $hanoks->get();

    // foreach ($results as $result) {
    //     echo $result->hanok_name;
    //     echo $result->hanok_img1;
    //     echo $result->hanok_local;
    //     echo $result->room_price;  
    // }
    return view('/main')->with('hanok', $hanoks);
}
}