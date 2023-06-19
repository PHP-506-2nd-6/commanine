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
    public function hanoksDetail($id) {
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
                        ->get();
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
        // TODO 리턴값 확인용  // return var_dump($hanoks);
        // return view('detail')->with('hanok', $hanoks); // 0615 KMJ del
        return view('detail')->with('hanok', $hanoks)->with('rooms', $rooms)->with('likes', $likes[0])->with('reviews', $reviews); // 0615 KMJ new
    }
}
